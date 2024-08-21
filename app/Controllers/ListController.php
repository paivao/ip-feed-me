<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\IPEntry;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ListModel;
use App\Models\IPEntryModel;

class ListController extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        $lists = model(ListModel::class)->findAll();
        $mapped_list = [];
        array_walk($lists, function ($e) use (&$mapped_list) {
            $mapped_list[$e['name']] = site_url("/list/{$e['id']}");
        });
        return view("lists/home", [
            "title" => "Lists",
            "user" => auth()->user(),
            "lists" => $mapped_list,
        ]);
    }

    public function get(int $id)
    {
        $listModel = model(ListModel::class);
        $entryModel = model(IPEntryModel::class);

        $list = $listModel->find($id);

        if (is_null($list)) {
            return $this->response->setHeader('HX-Redirect', site_url('/errors/not_found?reason=List+not+found'));
        }

        return view('lists/get', [
            'title' => $listModel->find($id)['name'],
            'entries' => $entryModel->where('list_id', $id)->paginate(10),
            'pager' => $entryModel->pager,
        ]);
    }

    public function new()
    {
        $listModel = model(ListModel::class);

        $data = $this->request->getPost(array_keys($listModel->getValidationRules()));

        $data['created_by'] = auth()->user()->id;
        if (! $listModel->insert($data, false)) {
            return view_cell('AlertCell', [
                'type' => 'danger',
                'messages' => $listModel->errors(),
            ]);
        }

        $list_id = $listModel->getInsertID();
        return $this->response->setHeader('HX-Redirect', site_url("/list/{$list_id}"));
    }

    public function edit(int $id)
    {
        $listModel = model(ListModel::class);
        $entryModel = model(IPEntryModel::class);

        $list = $listModel->find($id);
        $data = [
            'title' => 'Edit List ' . $list['name'],
            "user" => auth()->user(),
            'list' => $list,
            'entries' => $entryModel->paginate(10),
            'pager' => $entryModel->pager,
        ];

        return view('lists/edit', $data);
    }

    public function manage_ip(int $id)
    {
        $entryModel = model(IPEntryModel::class);
        $action = $this->request->getPost('action');
        if ($action === 'new-ip') {
            $data = array_filter($this->request->getPost(array_keys($entryModel->getValidationRules())));
            $entry = new IPEntry;
            $entry->fill($data);
            $entry->list_id = $id;
            if ($entryModel->save($entry) === false) {
                return view_cell('AlertCell', [
                    'type' => 'danger',
                    'messages' => $entryModel->errors(),
                ]);
            }
            return $this->get($id) . view_cell('AlertCell', [
                'type' => 'success',
                'messages' => ['IP adicionado com sucesso!'],
            ]);
        }

        return redirect()->back();
    }

    public function show(string $name)
    {
        $list = model(ListModel::class)->where('name', $name)->first();
        if (is_null($list))
            return $this->response->setStatusCode(404)->setBody("Not Found.");
        $entries = model(IPEntryModel::class)->where('list_id', $list['id'])->findAll();
        $body = '';
        foreach ($entries as $entry) {
            $body .= "{$entry->ip_address}\n";
        }
        return $this->response->setContentType('text/plain')->setBody($body);
    }
}
