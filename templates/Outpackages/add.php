<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Outpackage $outpackage
 * @var \Cake\Collection\CollectionInterface|string[] $sheets
 */
?>
<div class="row">
    <aside class="column">
    </aside>
    <div class="column-responsive column-80">
        <div class="outpackages form content">
            <?= $this->Form->create($outpackage) ?>
            <fieldset>
                <legend><?= __('Ajouter un hors forfait') ?></legend>
                <?php
                echo $this->Form->control('date', ['label' => "Date de création de l'hors forfait"]);
                echo $this->Form->control('price', ['label' => 'Prix du hors forfait']);
                echo $this->Form->control('title', ['label' => 'Nom du hors forfait']);
                echo $this->Form->control('body', ['label' => 'Contenu']);
                echo $this->Form->control('sheets._ids', [
                    'label' => 'Fiche',
                    'options' => [
                        $this->request->getParam('pass.0') => $this->request->getParam('pass.0')
                    ],
                    'empty' => true,
                    'value' => $this->request->getParam('pass.0')
                ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Envoyer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
