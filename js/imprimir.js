document.querySelector('.imprimir').onclick = function() {
var conteudo = document.querySelector('#imprimir').innerHTML,
tela_impressao = window.open('about:blank');

tela_impressao.document.write(conteudo);
tela_impressao.window.print();
tela_impressao.window.close();
};