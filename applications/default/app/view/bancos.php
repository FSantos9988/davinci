<!-- Actions bar -->
<div class="zdk-action-bar" data-zdk-dialog="dlg_bancos"
                            data-zdk-datatable="table_bancos">
    <!-- Action buttons -->
    <button class="zdk-bt-add" title="Novo Banco">Novo</button>
    <button class="zdk-bt-edit" data-zdk-noselection="Por favor, selecione primeiro um banco para editar" title="Editar Banco">Editar</button>
    <button class="zdk-bt-remove" data-zdk-noselection="Por favor, selecione primeiro um banco para deletar" title="Deletar Banco"
            data-zdk-confirm="Você realmente deseja deletar este banco?:Sim:Não"
            data-zdk-action="bancosctrl:remove">Deletar</button>
</div>
<div id="table_bancos" class="zdk-datatable" title="Bancos"
        data-znk-paginator="10" 
        data-zdk-action="bancosctrl:data"
        data-zdk-columns='[
                {"field":"nome", "headerText": "Nome"},
                {"field":"codigo_febraban", "headerText": "Cód. FEBRABAN"},
                {"field":"site", "headerText": "Site"}
]'>
</div>
<div id="dlg_bancos" class="zdk-modal" title="Bancos">
    <form class="zdk-form"
        data-zdk-action="bancosctrl:save"
        data-zdk-datatable="table_bancos">
        <label>Código : </label>
        <input name="id" disabled type="text">
        <label>Nome : </label>
        <input name="nome" maxlength="100" required type="text">
        <label>Cód. FEBRABAN : </label>
        <input name="codigo_febraban" maxlength="5" type="text">
        <label>Site : </label>
        <input name="site" maxlength="255" type="text">
        <button class="zdk-bt-save zdk-close-dialog" type="submit">Salvar</button>
        <button class="zdk-bt-cancel zdk-close-dialog" type="button">Cancelar</button>
    </form>
</div>