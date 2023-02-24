<?php

use yii\helpers\Url;

?>

<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">Sobre</h4>
                    <p class="text-muted">Este site é dedicado ao trabalho de conclusão de curso de pós-graduação do curso de Desenvolvimento Web Full Stack da Universidade Unyleya. O projeto foi desenvolvido por Caio Henrique Barbosa Garcia e tem como objetivo demonstrar as habilidades adquiridas durante o curso. O trabalho incluiu a utilização de várias tecnologias para desenvolver uma aplicação web completa, desde o frontend até o backend. Se você está interessado em conhecer mais detalhes sobre o projeto, fique à vontade para explorar as diferentes seções deste site.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contatos</h4>
                    <ul class="list-unstyled">
                        <li><a target="_blank" href="https://github.com/caiobarbosadev" class="text-white">GitHub</a></li>
                        <li><a target="_blank" href="mailto:caio.henrique@sou.unifeob.edu.br" class="text-white">Email</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>Produtos Unyleya</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1>Listagem de produtos</h1>
            <p class="lead text-muted">Confira a listagem de produtos.</p>
            <p>
                <button id="buttonOpenModalAddProduct" class="btn btn-primary my-2">
                    Adicionar novo produto
                </button>
            </p>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <table style="border: 1px solid #dee2e6;" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php if ($products) { ?>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td style="vertical-align: middle;"><?php echo ($product['id']); ?></td>
                                <td style="vertical-align: middle;"><?php echo ($product['nome']); ?></td>
                                <td style="vertical-align: middle;"><?php echo ($product['preco']); ?></td>
                                <td style="vertical-align: middle;">
                                    <button class="btn btn-sm btn-outline-primary" onclick="openEditProductModal('<?php echo $product['id']; ?>')">Editar</button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="openDeleteProductModal('<?php echo $product['id']; ?>')">Excluir</button>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<footer class="text-muted">
    <div class="container">
        <p style="margin-top: 1rem;">Todos os direitos reservados.</p>
    </div>
</footer>

<!-- Add product modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form onsubmit="addNewProduct(event)">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="productName">Nome do produto</label>
                        <input required type="text" class="form-control" id="productName" placeholder="Digite o nome do produto" />
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Preço do produto</label>
                        <input pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any" required type="number" class="form-control" id="productPrice" placeholder="Digite o preço do produto" />
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Edit product modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form onsubmit="editProduct(event)">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input hidden type="text" class="form-control" id="productIdEdit" />

                    <div class="form-group">
                        <label for="productNameEdit">Nome do produto</label>
                        <input required type="text" class="form-control" id="productNameEdit" />
                    </div>
                    <div class="form-group">
                        <label for="productPriceEdit">Preço do produto</label>
                        <input pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any" required type="number" class="form-control" id="productPriceEdit" />
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Delete product modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form onsubmit="deleteProduct(event)">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apagar produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input hidden type="text" class="form-control" id="productIdDelete" />

                    <div class="form-group">
                        <label for="productNameEdit">Nome do produto</label>
                        <input disabled readonly required type="text" class="form-control" id="productNameDelete" />
                    </div>
                    <div class="form-group">
                        <label for="productPriceEdit">Preço do produto</label>
                        <input disabled readonly required type="number" class="form-control" id="productPriceDelete" />
                    </div>

                    <button type="submit" class="btn btn-danger">Apagar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
    $('#buttonOpenModalAddProduct').on('click', () => {
        $('#addProductModal').modal('show');
    })

    function addNewProduct(event) {
        event.preventDefault();

        const productName = $('#productName').val();
        const productPrice = $('#productPrice').val();

        const link = '<?php echo Url::base() ?>/index.php?r=site/create';

        $.ajax({
            url: link,
            type: 'POST',
            dataType: 'JSON',
            data: {
                productName,
                productPrice
            },
            success: function(response) {
                if (response === 201) {
                    alert('Produto cadastrado com sucesso!');

                    updateProductList();

                    $('#addProductModal').modal('hide');

                    $('#productName').val('');
                    $('#productPrice').val('');
                }
            },
            error: function(error) {
                console.log(error.responseText);
            }
        });
    }

    function updateProductList() {
        const link = '<?php echo Url::base() ?>/index.php?r=site/listall';

        $.ajax({
            url: link,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                const products = response;

                $('#table-body').html('');

                products.map(product => {
                    $('#table-body').append(`
                        <tr>
                            <td style="vertical-align: middle;">${product.id}</td>
                            <td style="vertical-align: middle;">${product.nome}</td>
                            <td style="vertical-align: middle;">${product.preco}</td>
                            <td style="vertical-align: middle;">
                                <button class="btn btn-sm btn-outline-primary" onclick="openEditProductModal('${product.id}')">Editar</button>
                                <button class="btn btn-sm btn-outline-danger" onclick="openDeleteProductModal('${product.id}')">Excluir</button>
                            </td>
                        </tr>
                    `);
                })
            },
            error: function(error) {
                console.log(error.responseText);
            }
        });
    }

    function openEditProductModal(productId) {
        const link = '<?php echo Url::base() ?>/index.php?r=site/listone';

        $.ajax({
            url: link,
            type: 'POST',
            dataType: 'JSON',
            data: {
                productId
            },
            success: function(response) {
                const product = response;

                $('#productIdEdit').val(product.id);
                $('#productNameEdit').val(product.nome);
                $('#productPriceEdit').val(product.preco);

                $('#editProductModal').modal('show');
            },
            error: function(error) {
                console.log(error.responseText);
            }
        });
    }

    function editProduct(event) {
        event.preventDefault();

        const productId = $('#productIdEdit').val();
        const productName = $('#productNameEdit').val();
        const productPrice = $('#productPriceEdit').val();

        const link = '<?php echo Url::base() ?>/index.php?r=site/update';

        $.ajax({
            url: link,
            type: 'POST',
            dataType: 'JSON',
            data: {
                productId,
                productName,
                productPrice
            },
            success: function(response) {
                if (response === 200) {
                    alert('Produto editado com sucesso!');

                    $('#editProductModal').modal('hide');

                    updateProductList();
                }
            },
            error: function(error) {
                console.log(error.responseText);
            }
        });
    }

    function openDeleteProductModal(productId) {
        const link = '<?php echo Url::base() ?>/index.php?r=site/listone';

        $.ajax({
            url: link,
            type: 'POST',
            dataType: 'JSON',
            data: {
                productId
            },
            success: function(response) {
                const product = response;

                $('#productIdDelete').val(product.id);
                $('#productNameDelete').val(product.nome);
                $('#productPriceDelete').val(product.preco);

                $('#deleteProductModal').modal('show');
            },
            error: function(error) {
                console.log(error.responseText);
            }
        });
    }

    function deleteProduct(event) {
        event.preventDefault();

        const productId = $('#productIdDelete').val();

        const link = '<?php echo Url::base() ?>/index.php?r=site/delete';

        $.ajax({
            url: link,
            type: 'POST',
            dataType: 'JSON',
            data: {
                productId
            },
            success: function(response) {
                if (response === 204) {
                    alert('Produto apagado com sucesso!');

                    $('#deleteProductModal').modal('hide');

                    updateProductList();
                }
            },
            error: function(error) {
                console.log(error.responseText);
            }
        });
    }
</script>