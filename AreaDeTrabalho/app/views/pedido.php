<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="statics/css/style.css" /> 
    <title>Nova Requisição de Serviço</title>
</head>
<body class="bg-light">
    
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sistema de Requisições</a>
                <div class="d-flex">
                     <a href="" class="btn btn-outline-light">Voltar ao Painel</a>
                </div>
            </div>
        </nav>
    </header>
    
    <main class="container my-5">
        
        <div class="row mb-4">
            <div class="col-12" id="bem_vindo">
                <div class="p-4 bg-white rounded shadow-sm border-start border-primary border-5">
                    <h1 class="text-primary">
                        Bem Vindo, <span class="fw-bold">Paciente Exemplo</span>
                    </h1>
                    <p class="mb-0">
                        Use o formulário abaixo para solicitar serviços de suporte. Preencha o tipo de pedido e forneça uma breve descrição.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="/caminho/para/seu/controller.php" method="post" id="form-requisicao">
                    <div class="card p-4 shadow border-0">
                        <h2 class="card-title mb-4 text-secondary">Formulário de Pedido de Serviço</h2>
                        
                        <input type="hidden" name="status_pedido" value="Pendente"> <input type="hidden" name="id_paciente" value="123">       <input type="hidden" name="id_setor" value="1">           <div class="mb-3">
                            <label class="form-label fw-bold">Selecione o Tipo de Pedido:</label>
                            <div class="d-flex flex-wrap gap-3" id="box-btn-tipo_pedido">
                                
                            <!-- Botões para seleção do especialista -->

                                <button type="submit" name="tipo_pedido" value="enfermagem" class="btn btn-outline-primary btn-lg d-flex align-items-center" style="min-width:200px">
                                    <span style="padding: 10px;">
                                        <i class="fa-solid fa-user-doctor fa-2x" style="padding-right: 10px;"></i>
                                        Enfermagem
                                    </span>
                                </button>
                                
                                <button type="submit" name="tipo_pedido" value="camareira" class="btn btn-outline-info btn-lg d-flex align-items-center">
                                    <span style="padding: 10px;">
                                        <i class="fa-solid fa-bed fa-2x" style="padding-right: 10px;"></i>
                                        Camareira
                                    </span>
                                </button>
                                
                                <button type="submit" name="tipo_pedido" value="manutencao" class="btn btn-outline-warning btn-lg d-flex align-items-center">
                                    <span style="padding: 10px;">
                                        <i class="fa-solid fa-screwdriver-wrench fa-2x" style="padding-right: 10px;"></i>
                                        Manutenção
                                    </span>
                                </button>
                                
                                <button type="submit" name="tipo_pedido" value="cozinha" class="btn btn-outline-success btn-lg d-flex align-items-center">
                                    <span style="padding: 10px;">
                                        <i class="fa-solid fa-bell-concierge fa-2x" style="padding-right: 10px;"></i>
                                        Cozinha
                                    </span>
                                </button>
                                
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descricao_breve" class="form-label fw-bold">Descrição Detalhada do Serviço:</label>
                            <textarea 
                                name="descricao" 
                                id="descricao_breve" 
                                class="form-control" 
                                rows="4" 
                                placeholder="Descreva a necessidade com mais detalhes..." 
                                required
                            ></textarea>
                            </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Enviar Requisição
                            </button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-q0Co2Wv8sW9wY/mB8wzQ7fF3Z1tG8J9Z7oJ7oB4Z2c2O4k7fG9jFq0n+8lD5gB1Q"
      crossorigin="anonymous"
    ></script>
</body>
</html>
