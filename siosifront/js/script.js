var urlSubdomain = (((window.location.toString()).split("."))[0].split("//"))[1];
var urlAtual = window.location.href+'/../pages/';
var urlApi = 'https://'+urlSubdomain+'.d2wdigital.com.br/siosiapi-dev/api/';
// var urlApi = 'https://siosi.d2wdigital.com.br/siosiapi-dev/api/';
// var urlApi = 'https://siosi.d2wdigital.com.br/siosiapi/api/';
// var urlApi = 'http://siosiapilocal.br/public/api/';

// Paginação
function PaginacaoNumeracao(dados,paginacao){
    $(".PaginacaoNumeracao").each(function(){$(this).text((paginacao.pagina+1)+' - '+Math.ceil(dados.length/paginacao.tamanhoPagina));});
    $(".PaginacaoItens").each(function(){$(this).val(paginacao.tamanhoPagina);});
}
function PaginacaoItens(numero,dados,paginacao) {
    paginacao.tamanhoPagina = numero;
    if (numero*paginacao.pagina <= dados.length && paginacao.pagina > 0) {
        paginacao.pagina--;
    }
    paginar(dados,paginacao);
}
function PaginacaoProximo(dados,paginacao){
    if (paginacao.pagina < dadosListagem.length / paginacao.tamanhoPagina - 1) {
        paginacao.pagina++;
        paginar(dados,paginacao);
    }
}
function PaginacaoAnterior(dados,paginacao){
    if (paginacao.pagina > 0) {
        paginacao.pagina--;
        paginar(dados,paginacao);
    }
}
// busca filtro
function PaginacaoBusca(termo,dados,paginacao) {
    var novosDados = [];
    if (paginacao.tamanhoPagina*paginacao.pagina <= dados.length && paginacao.pagina > 0) {
        paginacao.pagina--;
    }
    for (var i = 0; i < dados.length; i++) {
        if (dados[i].empresaAtual != undefined) {if (removeAcentos(dados[i].empresaAtual.fantasia.toLowerCase()).indexOf(removeAcentos(termo.toLowerCase())) != -1) {novosDados.push({"empresaAtual":dados[i].empresaAtual,"cidadeEstado":dados[i].cidadeEstado});}}
        if (dados[i].usuario != undefined) {if (removeAcentos(dados[i].usuario.nome.toLowerCase()).indexOf(removeAcentos(termo.toLowerCase())) != -1) {novosDados.push({"usuario":dados[i].usuario,"permissoes":dados[i].permissoes,"papeis":dados[i].papeis});}}
        if (dados[i].ncItem != undefined) {if (removeAcentos(dados[i].ncItem.item.nome.toLowerCase()).indexOf(removeAcentos(termo.toLowerCase())) != -1) {novosDados.push({"ncItem":dados[i].ncItem});}}
        if (dados[i].papel != undefined) {if (removeAcentos(dados[i].papel.nome.toLowerCase()).indexOf(removeAcentos(termo.toLowerCase())) != -1) {novosDados.push({"papel":dados[i].papel});}}
    }
    dados = novosDados;
    paginar(dados,paginacao);
}
function ordenarPorDataDesc(a, b){
    if(a.auditoria.created_at>b.auditoria.created_at)return 1;
    if(a.auditoria.created_at<b.auditoria.created_at)return -1;
    return 0;
}
function ordenarPorDataAsc(a, b){
    if(b.auditoria.created_at>a.auditoria.created_at)return 1;
    if(b.auditoria.created_at<a.auditoria.created_at)return -1;
    return 0;
}





// retira acento (busca)
function removeAcentos(palavra) {
    com_acento = 'áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ';
    sem_acento = 'aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC';
    nova='';
    for(i=0;i<palavra.length;i++) {
        if (com_acento.search(palavra.substr(i,1))>=0) {
            nova+=sem_acento.substr(com_acento.search(palavra.substr(i,1)),1);
        }
        else {
            nova+=palavra.substr(i,1);
        }
    }
    return nova;
}
// validar permissoes
function validarPermissao(tarefa){
    var usuarioLogado = JSON.parse(localStorage.getItem('usuario'));
    if (usuarioLogado.email == "admin") {
        return true;
    }else {
        var permissoes = JSON.parse(localStorage.getItem('permissoes'));
        for (var i = 0; i < permissoes.length; i++) {
            if (permissoes[i].descricao == tarefa) {
                return true;
                break;
            }
        }
        var setores = JSON.parse(localStorage.getItem('setores'));
        for (var s = 0; s < setores.length; s++) {
            if (setores[s].id == tarefa) {
                return true;
                break;
            }
        }
    }
}
// textarea auto resize
function auto_grow(element) {
    element.style.height = (element.scrollHeight+2)+"px";
}
// oculta bloco com tipo diferente do selecionado e "ativa" o botao do selecionado
function mudaItemType(tipo){
    if ($(".mudaTipoItem").hasClass(tipo)) {
        $('.mudaTipoItem').removeClass('ativo');
        $('.'+tipo).addClass('ativo');
    }
    if ($(".ocultaTipoItem").hasClass(tipo)) {
        $('.ocultaTipoItem').removeClass('ativo');
        $('.'+tipo).addClass('ativo');
    }
}
// abrir modal
function abreModal(content){
    if (!$('.modal').hasClass('.'+content)) {
        $('.'+content).fadeIn();
    }
}
// fechar modal
function fechaModal(content){
    if (content == undefined) {
        $(".modal").fadeOut();
    }else{
        if (!$('.modal').hasClass('.'+content)) {
            $('.'+content).fadeOut();
        }
    }
}
// abrir acordion (adicionar classe accorion + uma identificação na div)
function abreAcordeon(id){
    if ($('.accordion').hasClass(id)) {
        if ($('.'+id).hasClass('ativo')) {
            $('.'+id).removeClass('ativo');
        }else{
            $('.'+id).addClass('ativo');
        }
    }
}
// carrega conteudo conforme menu lateral, ativa o selecionado e altera titulo menu topo
function mudaContent(content) {
    if (content != "submenu-administrativo") {
        $('.muda').fadeOut(100,function() {
            $('.carregando').fadeIn(100,function(){});
            $.ajax({
                url: urlAtual+content+'.php',
                success: function(retorno){
                    $('.muda').html(retorno);
                    $('.carregando').fadeOut(100,function(){
                        $('.muda').fadeIn(100,function(){
                            $(".fancybox").on("click", function(){
                                $.fancybox({
                                    href: this.href,
                                    type: $(this).data("type")
                                });
                                return false
                            });
                        });
                    });
                }
            });
        });
    }
    if ($('.url-topbar').hasClass(content)) {
        $(".url-topbar").fadeOut(0);
        $("."+content).fadeIn(0);
    }
    if ($('.item-menu').hasClass(content)) {
        $(".item-menu").removeClass('ativo');
        $(".submenu").removeClass('ativo');
        $(".item-submenu").removeClass('ativo');
        $("."+content).addClass('ativo');
    }
    if ($('.'+content).hasClass("item-submenu")) {
        $(".item-submenu").removeClass('ativo');
        $("."+content).addClass('ativo');
    }
};
// muda status sidebar (fixa-)
$(document).off("click", "#fixa-sidebar").on("click", "#fixa-sidebar", function(){
    if ($(".sidebar").hasClass("fixa")) {
        $(".sidebar").removeClass("fixa");
        $(".bloco-principal").removeClass("fixa");
        $(".topbar").removeClass("fixa");
    }else{
        $(".sidebar").addClass("fixa");
        $(".bloco-principal").addClass("fixa");
        $(".topbar").addClass("fixa");
    }
});
// validar se login existe
function verificaLogin(){
    if (!localStorage.getItem("token") || localStorage.getItem("token") == null) {
        alert('Usuários desconectado');
        location.href = "index.php";
    }else {
        if (true) {

        }
    }
}
// logout
function logout(){
    localStorage.clear();
    location.href="index.php";
}
// login
$(document).off("submit", "#login").on("submit", "#login", function(){
    event.preventDefault();
    var data = {
        "email": $("#loginEmail").val(),
        "password": $("#loginSenha").val()
    };
    $.post(urlApi+"login", data, function (response) {
        if (response.token) {
            localStorage.setItem('token', response.token);
            localStorage.setItem('setores', JSON.stringify(response.setores));
            localStorage.setItem('permissoes', JSON.stringify(response.permissoes));
            localStorage.setItem('papeis', JSON.stringify(response.papeis));
            localStorage.setItem('usuario', JSON.stringify(response.id_user));
            location.href = "home.php";
        }
    }).fail(function () {
        $("#loginEmail").val("");
        $("#loginSenha").val("");
        $("#erro").fadeOut();
        $("#erro").fadeIn();
    });
});
