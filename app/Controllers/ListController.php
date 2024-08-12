<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\IPEntry;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ListModel;
use App\Models\IPEntryModel;

class ListController extends BaseController
{
    const LIST_RULES = [
        'name' => 'alpha_dash|max_length[64]|required',
        'description' => 'max_length[255]',
        'is_public' => 'required'
    ];

    const ENTRY_RULES = [
        'ip_address' => 'valid_ip|required',
        'description' => 'max_length[255]'
    ];

    protected $helpers = ['form'];

    public function index()
    {
        $lists = model(ListModel::class)->findAll();
        return view("list", [
            "title" => "Lists",
            "user" => auth()->user(),
            "lists" => $lists,
        ]);
    }

    public function new()
    {
        if (! $this->request->is('post')) {
            return $this->index();
        }

        $data = $this->request->getPost(array_keys(self::LIST_RULES));

        if (! $this->validateData($data, self::LIST_RULES)) {
            return $this->index();
        }
        $listModel = model(ListModel::class);
        $validData = $this->validator->getValidated();
        $validData['created_by'] = auth()->user()->id;
        if (! $listModel->insert($validData, false)) {
            // TODO adicionar erro
            return $this->index();
        }

        $list = $listModel->getInsertID();
        return redirect()->to("/list/edit/{$list}");
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
        if (! $this->request->is('post')) {
            return $this->edit($id);
        }
        
        $data = $this->request->getPost(array_keys(self::ENTRY_RULES));
        $action = $this->request->getPost('action');
        if ($action == 'new-ip') {
            if (! $this->validateData($data, self::ENTRY_RULES)) {
                return $this->edit($id);
            }
            $entry = new IPEntry;
            $entryModel = model(IPEntryModel::class);
            $validData = $this->validator->getValidated();
            $entry->fill($validData);
            $entry->created_by = auth()->user()->id;
            $entry->list_id = $id;
            //return response()->setJSON($validData);
            if (! $entryModel->save($entry, true) ) {
                // TODO adicionar erro
                return $this->edit($id);
            }
        }

        return $this->response->redirect()->back();
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
