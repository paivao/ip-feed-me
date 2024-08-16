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
        return view("lists/home", [
            "title" => "Lists",
            "user" => auth()->user(),
            "lists" => $lists,
        ]);
    }

    public function get(int $id) {
        $listModel = model(ListModel::class);
        $entryModel = model(IPEntryModel::class);

        //$list = $listModel->find($id);

        return view('lists/get', [
            'title' => $listModel->find($id)['name'],
            'entries' => $entryModel->where('list_id', $id)->paginate(10),
            'pager' => $entryModel->pager,
        ]);
    }

    public function new()
    {
        if (! $this->request->is('post')) {
            return $this->index();
        }
        $listModel = model(ListModel::class);

        $data = $this->request->getPost(array_keys($listModel->getValidationRules()));

        $validData = $this->validator->getValidated();
        $validData['created_by'] = auth()->user()->id;
        if (! $listModel->insert($validData, false)) {
            // TODO adicionar erro
            return $this->index();
        }

        $list = $listModel->getInsertID();
        return redirect()->to("/list/{$list}");
    }

    public function edit(int $id) {
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

    public function manage_ip(int $id) {
        $entryModel = model(IPEntryModel::class);
        $action = $this->request->getPost('action');
        if ($action === 'new-ip') {
            $data = $this->request->getPost(array_keys($entryModel->getValidationRules()));
            $entry = new IPEntry;
            $entry->list_id = $id;
            $entry->fill($data);
            if ($entryModel->save($entry)) {
                session()->setFlashdata("message_ok", "IP adicionado com sucesso!");
            } else {
                
            }
            return $this->get($id);
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
        foreach($entries as $entry) {
            $body .= "{$entry->ip_address}\n";
        }
        return $this->response->setContentType('text/plain')->setBody($body);
    }
}
