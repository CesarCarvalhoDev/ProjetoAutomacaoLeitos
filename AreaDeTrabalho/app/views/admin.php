<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tela Admin - Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
    /* Estilo básico para as imagens placeholder */
    .logo_funcao {
        width: 60px;
        height: 60px;
        object-fit: contain;
    }

    /* --- CSS de Apoio Customizado --- */

    /* Ajusta o corpo para usar a fonte padrão do sistema para melhor legibilidade */
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
            "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji",
            "Segoe UI Emoji", "Segoe UI Symbol";
        background-color: #f8f9fa;
        /* Fundo cinza claro para a página */
    }

    /* Garante que o conteúdo principal tenha uma margem inferior adequada antes do footer */
    main.container {
        padding-bottom: 4rem;
    }

    /* Estilo para a imagem de logo na barra de navegação */
    #logo {
        width: 30px;
        height: 30px;
    }

    /* Estilo para a imagem de usuário na barra de navegação */
    #user {
        border: 2px solid #ffffff;
        /* Borda branca para destacar o avatar */
    }

    /* Estilo para as imagens dentro dos cards de funcionalidade */
    .logo_funcao {
        /* Define um tamanho fixo para manter a consistência */
        width: 60px;
        height: 60px;
        /* Garante que a imagem se ajuste sem distorcer, se for um ícone */
        object-fit: contain;
    }

    /* Adiciona um efeito de hover aos cards para melhorar a experiência do usuário */
    .card:hover {
        transform: translateY(-5px);
        /* Move o card levemente para cima */
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        /* Aumenta a sombra */
        transition: all 0.3s ease-in-out;
        /* Adiciona uma transição suave */
    }

    /* Resetando o estilo de transição para o estado normal */
    .card {
        transition: all 0.3s ease-in-out;
    }

    /* Estilo para o footer */
    .footer {
        border-top: 1px solid #e9ecef;
        /* Linha sutil no topo do footer */
    }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="/assets/273050775_611645833231749_8101898732572474785_n-fotor-bg-remover-20251117221339.png" alt="Logo" id="logo"
                        class="d-inline-block align-text-top me-2 rounded" />
                    Painel Administrativo
                </a>

                <div class="d-none d-md-block mx-auto"></div>

                <div class="d-flex align-items-center text-white">
                    <img src="https://via.placeholder.com/40/6c757d/ffffff?text=U" alt="Usuário" id="user"
                        class="rounded-circle me-2" width="40" height="40" />
                    <span class="fw-bold"><?php  ?></span>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-5">
        <h1 class="mb-4 text-primary">Dashboard de Funcionalidades</h1>

        <section id="section-funcoes">
            <div class="row g-4">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center shadow-sm border-0" id="funcao_cadastro_leito">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="https://via.placeholder.com/60/0d6efd/ffffff?text=L" alt="Ícone Leito"
                                class="logo_funcao mb-3" />
                            <h5 class="card-title">Cadastro de Setor</h5>
                            <a href="Admin/Setor/Cadastro" class="btn btn-primary mt-2 stretched-link">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center shadow-sm border-0" id="funcao_cadastro_leito">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="https://via.placeholder.com/60/0d6efd/ffffff?text=L" alt="Ícone Leito"
                                class="logo_funcao mb-3" />
                            <h5 class="card-title">Cadastro de Leito</h5>
                            <a href="Admin/Leito/Cadastro" class="btn btn-primary mt-2 stretched-link">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center shadow-sm border-0" id="funcao_cadastro_paciente">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="https://via.placeholder.com/60/dc3545/ffffff?text=P" alt="Ícone Paciente"
                                class="logo_funcao mb-3" />
                            <h5 class="card-title">Cadastro de Paciente</h5>
                            <a href="Admin/Paciente/Cadastro" class="btn btn-danger mt-2 stretched-link">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center shadow-sm border-0" id="funcao_cadastro_funcionario">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="https://via.placeholder.com/60/198754/ffffff?text=F" alt="Ícone Funcionário"
                                class="logo_funcao mb-3" />
                            <h5 class="card-title">Cadastro de Funcionários</h5>
                            <a href="Admin/Funcionario/Cadastro" class="btn btn-success mt-2 stretched-link">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="https://via.placeholder.com/60/ffc107/000000?text=R" alt="Ícone Requisições"
                                class="logo_funcao mb-3" />
                            <h5 class="card-title">Visualizar Requisições</h5>
                            <a href="Admin/Pedidos/Visualizar" class="btn btn-warning mt-2 stretched-link">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="https://via.placeholder.com/60/0dcaf0/000000?text=ML" alt="Ícone Modificar Leito"
                                class="logo_funcao mb-3" />
                            <h5 class="card-title">Modificar Leito</h5>
                            <a href="Admin/Leito/Modificar" class="btn btn-info mt-2 stretched-link">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="https://via.placeholder.com/60/6f42c1/ffffff?text=MP"
                                alt="Ícone Modificar Paciente" class="logo_funcao mb-3" />
                            <h5 class="card-title">Modificar Paciente</h5>
                            <a href="Admin/Paciente/Modificar" class="btn btn-secondary mt-2 stretched-link">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="https://via.placeholder.com/60/20c997/ffffff?text=ML2" alt="Ícone Modificar Leito"
                                class="logo_funcao mb-3" />
                            <h5 class="card-title">Modificar Leito</h5>
                            <a href="Admin/Leito/Modificar" class="btn btn-success mt-2 stretched-link">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="https://via.placeholder.com/60/fd7e14/ffffff?text=MF"
                                alt="Ícone Modificar Funcionário" class="logo_funcao mb-3" />
                            <h5 class="card-title">Modificar Funcionário</h5>
                            <a href="Admin/Funcionario/Modificar" class="btn btn-warning mt-2 stretched-link">Acessar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">Sistema de Administração &copy; 2025</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>