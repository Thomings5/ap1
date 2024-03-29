<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sheet $sheet
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $states
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Liste des fiches'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sheets form content">
            <?= $this->Form->create($sheet) ?>
            <fieldset>
                <legend><?= __('Ajouter une fiche') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['label' => 'Utilisateur', 'options' => $users, 'empty' => true]);
                    echo $this->Form->control('state_id', ['label' => 'État', 'options' => $states]);
                    echo $this->Form->control('sheetvalidated', ['label' => 'Fiche validée']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Envoyer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
