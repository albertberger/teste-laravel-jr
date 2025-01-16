<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #2C3E50;
            margin-bottom: 30px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        label {
            font-weight: 600;
            color: #34495E;
        }
        input, textarea, button {
            padding: 15px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #BDC3C7;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input:focus, textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        button {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }
        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group input[type="file"] {
            padding: 0;
        }
        .input-file-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .input-file-wrapper label {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 8px;
        }
        .input-file-wrapper input {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastrar Produto</h1>

        <!-- Exibição de erros de validação -->
        <?php if($errors->any()): ?>
            <div class="error">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Formulário de cadastro -->
        <form action="<?php echo e(route('product.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="name">Nome do Produto:</label>
                <input type="text" id="name" name="name" placeholder="Digite o nome do produto" value="<?php echo e(old('name')); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea id="description" name="description" rows="5" placeholder="Descreva o produto" required><?php echo e(old('description')); ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Preço (R$):</label>
                <input type="number" id="price" name="price" step="0.01" placeholder="Ex: 199.90" value="<?php echo e(old('price')); ?>" required>
            </div>

            <div class="form-group">
                <label for="stock">Quantidade em Estoque:</label>
                <input type="number" id="stock" name="stock" placeholder="Digite a quantidade disponível" value="<?php echo e(old('stock')); ?>" required>
            </div>

            <div class="form-group">
                <label for="category_id">Categoria:</label>
                <input type="text" id="category_id" name="category_id" placeholder="ID da categoria (Ex: MLB1234)" value="<?php echo e(old('category_id')); ?>" required>
            </div>

            <div class="form-group input-file-wrapper">
                <label for="image">Imagem do Produto:</label>
                <input type="file" id="image" name="image" required>
            </div>

            <button type="submit">Cadastrar Produto</button>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Votogames\desafio-mercado-livre\resources\views/products/create.blade.php ENDPATH**/ ?>