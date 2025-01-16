<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
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
        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            margin-bottom: 30px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #2980b9;
        }
        ul {
            list-style: none;
            padding: 0;
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }
        li {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        li:hover {
            transform: translateY(-5px);
        }
        li img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        li .product-info {
            display: flex;
            flex-direction: column;
        }
        li .product-info span {
            font-weight: 600;
            color: #34495E;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Produtos Cadastrados</h1>
        <a class="button" href="{{ route('product.create') }}">Cadastrar Novo Produto</a>

        <ul>
            @forelse ($products as $product)
                <li>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Imagem do Produto">
                    <div class="product-info">
                        <span>Nome:</span> {{ $product->name }}<br>
                        <span>Preço:</span> R$ {{ number_format($product->price, 2, ',', '.') }}<br>
                        <span>Quantidade:</span> {{ $product->stock }}<br>
                        <span>Categoria:</span> {{ $product->category_id }}
                    </div>
                </li>
            @empty
                <p>Nenhum produto cadastrado.</p>
            @endforelse
        </ul>
    </div>
</body>
</html>
