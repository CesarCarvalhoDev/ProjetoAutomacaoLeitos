<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <title>Login</title>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <main>
        <div class="card shadow p-4" id="form-card-login">
            <form action="Admin/login/submit" method="post">
                <h4 class="text-center mb-4">Login</h4>

                <div class="mb-3">
                    <label for="input_email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="input_email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="input_senha" class="form-label">Senha:</label>
                    <input type="password" class="form-control" id="input_senha" name="senha" required>
                </div>

                <button type="submit" class="btn btn-primary w-100" name="acao" value="login">Enviar</button>
            </form>
        </div>
    </main>
</body>
</html>
