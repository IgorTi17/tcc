var testecliente = document.querySelector('.testecliente');
	var testefornecedor = document.querySelector('.testefornecedor');
	var testemedicamentos = document.querySelector('.testemedicamentos');

	document.querySelector('.botaoCliente').addEventListener('click', function(){
        testecliente.classList.remove("some");
        testefornecedor.classList.add("some");
        testemedicamentos.classList.add("some");
	});

	document.querySelector('.botaoFornecedor').addEventListener('click', function(){
		testecliente.classList.add("some");
        testefornecedor.classList.remove("some");
        testemedicamentos.classList.add("some");
	});

	document.querySelector('.botaoMedicamento').addEventListener('click', function(){
		testecliente.classList.add("some");
        testefornecedor.classList.add("some");
        testemedicamentos.classList.remove("some");
	});

