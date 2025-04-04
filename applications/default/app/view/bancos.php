<!-- Actions bar -->
<div class="zdk-action-bar" data-zdk-dialog="dlg_bancos"
                            data-zdk-datatable="table_bancos">
    <!-- Action buttons -->
    <button class="zdk-bt-add" title="Novo Banco">Novo</button>
    <button class="zdk-bt-edit" data-zdk-noselection="Por favor, selecione primeiro um banco para editar" title="Editar Banco">Editar</button>
    <button class="zdk-bt-remove" data-zdk-noselection="Por favor, selecione primeiro um banco para deletar" title="Deletar Banco"
            data-zdk-confirm="Você realmente deseja deletar este banco?:Sim:Não"
            data-zdk-action="bancosctrl:remove">Deletar</button>
    <!-- Number of rows per page -->
    <select class="zdk-select-rows" title="Rows">  
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="100">All</option>
    </select>
    <!-- Search form -->
    <div class="zdk-filter-rows">
        <input title="procurar..." data-zdk-action="bancosctrl:suggestions">
        <button class="zdk-bt-clear" title="Limpar pesquisa..."></button>
        <button class="zdk-bt-search" title="Buscar bancos que atendam a pesquisa..."
                data-zdk-novalue="Por favor, digite um termo para pesquisar."></button>
    </div>
</div>
<!-- Datatable -->
<div id="table_bancos" class="zdk-datatable zdk-synchronize zdk-filter-rows" title="Bancos"
        data-zdk-paginator="10" 
        data-zdk-action="bancosctrl:data"
        data-zdk-columns='[
                {"field":"id", "headerText": "ID", "sortable": false},
                {"field":"nome", "headerText": "Nome", "sortable": true},
                {"field":"codigo_febraban", "headerText": "Cód. FEBRABAN", "sortable": true},
                {"field":"site", "headerText": "Site", "sortable": true}
]'>
</div>
<!-- Form dialog -->
<div id="dlg_bancos" class="zdk-modal" title="Bancos"
    data-zdk-confirm="Você deseja cancelar as alterações?:Sim:Não">
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
<style>  
    #table_bancos tr > td:first-of-type, #table_bancos thead > th:first-of-type {
        text-align: left;
        width: 8%;
    }

    #table_bancos tr > td:nth-of-type(2), #table_bancos thead > th:nth-of-type(2) {
        text-align:left;
        width:35%;
    }

    #table_bancos tr > td:nth-of-type(3), #table_bancos thead > th:nth-of-type(3) {
        text-align: left;
        width: 10%;
    }

    #table_bancos tr > td:last-of-type, #table_bancos thead > th:last-of-type {
        text-align:left;
        width:47%;
    }
</style>