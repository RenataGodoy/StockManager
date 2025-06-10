@extends('layouts.app')

@section('content')
    <div class="container-vendas">
        <h1>Venda de Produtos</h1>

        @if(session('success'))
            <div class="message success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="message error">
                {{ session('error') }}
            </div>
        @endif

        <table>
            <thead>
            <tr>
                <th>CÓD</th>
                <th>PRODUTO</th>
                <th>DESCRIÇÃO</th>
                <th>VALOR</th>
                <th>QTD ESTOQUE</th>
                <th>QTD VENDA</th>
                <th>AÇÕES</th>
            </tr>
            </thead>
            <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->descricao }}</td>
                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td>{{ $produto->quantidade }}</td>
                    <td>
                        <form action="{{ route('vendas.store', $produto->id) }}" method="POST" class="form-venda" onsubmit="return confirm('Tem certeza que deseja vender produto?');">
                            @csrf
                            <input type="number" name="quantidade_vendida" min="1" max="{{ $produto->quantidade }}" value="1" required>
                    </td>
                    <td>
                        <button type="submit">Vender</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <style>
        /* Container principal */
        .container-vendas {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .container-vendas h1 {
            color: #333;
            margin-bottom: 25px;
            font-size: 28px;
            font-weight: 600;
        }

        /* Mensagens de alerta */
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 500;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        /* Estilo principal da tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #f2f2f2;
            color: #1a202c;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
        }

        /* Efeitos nas linhas */
        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        tbody tr:nth-child(even) {
            background-color: #fbfbfb;
        }

        /* Formulário de venda */
        .form-venda {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Input de quantidade */
        input[type="number"] {
            width: 70px;
            padding: 8px 10px;
            border: 2px solid #e1e5e9;
            border-radius: 6px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        }

        /* Botão de venda */
        button[type="submit"] {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        button[type="submit"]:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        /* Melhorias visuais específicas */
        td:first-child {
            font-weight: 600;
            color: #007bff;
        }

        td:nth-child(2) {
            font-weight: 600;
            color: #343a40;
        }

        td:nth-child(4) {
            font-weight: 600;
            color: #28a745;
            font-size: 15px;
        }

        td:nth-child(5) {
            font-weight: 600;
            color: #6c757d;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container-vendas {
                padding: 15px;
            }

            .container-vendas h1 {
                font-size: 24px;
            }

            table {
                font-size: 13px;
            }

            th, td {
                padding: 10px 8px;
            }

            input[type="number"] {
                width: 60px;
                padding: 6px;
            }

            button[type="submit"] {
                padding: 8px 16px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .form-venda {
                flex-direction: column;
                gap: 5px;
            }

            input[type="number"],
            button[type="submit"] {
                width: 100%;
            }
        }

        /* Animação sutil para carregamento */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        table {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
@endsection

@section('scripts')
    @if($temEstoqueBaixo)
        <script>
            // Notificação moderna para estoque baixo
            window.addEventListener('DOMContentLoaded', function() {
                const notification = document.createElement('div');
                notification.innerHTML = `
                    <div style="
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background: #ff6b6b;
                        color: white;
                        padding: 15px 25px;
                        border-radius: 8px;
                        box-shadow: 0 4px 20px rgba(255, 107, 107, 0.3);
                        z-index: 1000;
                        font-family: Arial, sans-serif;
                        font-weight: 600;
                        animation: slideIn 0.5s ease;
                        max-width: 350px;
                    ">
                        ⚠️ Atenção! Há produtos com estoque abaixo de 10 unidades.
                        <button onclick="this.parentElement.parentElement.remove()" style="
                            background: none;
                            border: none;
                            color: white;
                            cursor: pointer;
                            font-size: 18px;
                            font-weight: bold;
                            float: right;
                            margin-left: 15px;
                        ">&times;</button>
                    </div>
                `;

                // Adicionar CSS da animação
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes slideIn {
                        from { transform: translateX(100%); opacity: 0; }
                        to { transform: translateX(0); opacity: 1; }
                    }
                `;
                document.head.appendChild(style);
                document.body.appendChild(notification);

                // Remover automaticamente após 6 segundos
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.style.animation = 'slideIn 0.5s ease reverse';
                        setTimeout(() => notification.remove(), 500);
                    }
                }, 6000);
            });
        </script>
    @endif
@endsection
