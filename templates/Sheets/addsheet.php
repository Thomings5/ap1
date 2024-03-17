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
                <?= $this->Form->hidden('user_id', ['value' => $iduser]) ?>
                <?= $this->Form->hidden('state_id', ['label' => 'État', 'options' => $states, 'value'=>1]) ?>
                <?= $this->Form->hidden('sheetvalidated', ['label' => 'Fiche validée', 'value'=>0]) ?>
            </fieldset>
            <?= $this->Form->button(__('Envoyer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>