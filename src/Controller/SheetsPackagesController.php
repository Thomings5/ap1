<?php
declare(strict_types=1);

namespace App\Controller;
use App\Model\Table\SheetsPackagesTable;

/**
 * Sheets Controller
 *
 * @property \App\Model\Table\SheetsTable $Sheets
 * @method \App\Model\Entity\Sheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SheetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'States'],
        ];
        $sheets = $this->paginate($this->Sheets);

        $this->set(compact('sheets'));
    }

    /**
     * View method
     *
     * @param string|null $id Sheet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sheet = $this->Sheets->get($id, [
            'contain' => ['Users', 'States', 'Outpackages', 'Packages'],
        ]);

        $this->set(compact('sheet'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
{
    $sheet = $this->Sheets->newEmptyEntity();

    if ($this->request->is('post')) {
        $sheet = $this->Sheets->patchEntity($sheet, $this->request->getData());

        if ($this->Sheets->save($sheet)) {
            // Récupérez l'id de la nouvelle feuille
            $sheetId = $sheet->id;

            // Créez une nouvelle entrée dans la table sheet_packages avec package_id = 1
            $this->createSheetPackage($sheetId, 1, 0);

            // Créez une autre entrée dans la table sheet_packages avec package_id = 2
            $this->createSheetPackage($sheetId, 2, 0);

            // Créez une autre entrée dans la table sheet_packages avec package_id = 3
            $this->createSheetPackage($sheetId, 4, 0);

            $this->Flash->success(__('The sheet has been saved.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The sheet could not be saved. Please, try again.'));
        }
    }

        $users = $this->Sheets->Users->find('list', ['limit' => 200])->all();
        $states = $this->Sheets->States->find('list', ['limit' => 200])->all();
        $outpackages = $this->Sheets->Outpackages->find('list', ['limit' => 200])->all();
        $packages = $this->Sheets->Packages->find('list', ['limit' => 200])->all();
        $this->set(compact('sheet', 'users', 'states', 'outpackages', 'packages'));
    }

    private function createSheetPackage($sheetId, $packageId, $quantity)
{
    $sheetPackagesTable = new SheetsPackagesTable();
    $sheetPackage = $sheetPackagesTable->newEmptyEntity();

    $data = [
        'sheet_id' => $sheetId,
        'package_id' => $packageId,
        'quantity' => $quantity,
    ];

    $sheetPackage = $sheetPackagesTable->patchEntity($sheetPackage, $data);

    if (!$sheetPackagesTable->save($sheetPackage)) {
        $this->Flash->error(__('Error creating sheet package.'));
    }
}

    /**
     * Edit method
     *
     * @param string|null $id Sheet id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sheet = $this->Sheets->get($id, [
            'contain' => ['Outpackages', 'Packages'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sheet = $this->Sheets->patchEntity($sheet, $this->request->getData());
            if ($this->Sheets->save($sheet)) {
                $this->Flash->success(__('The sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sheet could not be saved. Please, try again.'));
        }
        $users = $this->Sheets->Users->find('list', ['limit' => 200])->all();
        $states = $this->Sheets->States->find('list', ['limit' => 200])->all();
        $outpackages = $this->Sheets->Outpackages->find('list', ['limit' => 200])->all();
        $packages = $this->Sheets->Packages->find('list', ['limit' => 200])->all();
        $this->set(compact('sheet', 'users', 'states', 'outpackages', 'packages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sheet id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sheet = $this->Sheets->get($id);
        if ($this->Sheets->delete($sheet)) {
            $this->Flash->success(__('The sheet has been deleted.'));
        } else {
            $this->Flash->error(__('The sheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function list()
    {
        $this->paginate = [
            'contain' => ['Users', 'States'],
        ];

        $identity = $this->getRequest()->getAttribute('identity');
        $identity = $identity ?? [];
        $iduser = $identity["id"];
        
        $sheets = $this->paginate($this->Sheets->find('all')->where(['user_id' => $iduser]));

        $this->set(compact('sheets'));
    }
    public function votreAction($packageId)
{
    if ($this->request->is('post') && $this->request->getData('save_quantity')) {
        $data = $this->request->getData();
        $quantity = $data["packages"][$packageId]["quantity"];
        
        // Update the quantity in the database using $packageId and $quantity
        // Add your logic here to update the database record
        
        // Redirect or set flash messages as needed
        $this->Flash->success(__('Quantity updated successfully.'));
        return $this->redirect(['action' => 'index']); // Redirect to the appropriate action
    }
}
}