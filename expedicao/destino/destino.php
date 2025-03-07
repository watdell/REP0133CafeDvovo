<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/cssdestino.css">


    
    <title>Sistema - Café de Vovô</title>
</head>
<style>
    
</style>
<body>

    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>

    <main class="content">
        <div class="navbar" id="navbar"></div>

            <div>
                <section>
                <h1>Destino</h1>
                    <form id="formulario" action="inserir-destino.php" method="post">
                
                        <div id="bloco_cep">
                
                            <label for="name">Nome do lugar</label>
                            <input type="text" id="name" name="name" require>
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" require>
                
                            <div class="buttons-div">
                                <input class="button" type="submit" id="botao" value="Consultar CEP">
                                <input class="button" type="button" onclick="redirecionar()" value="Voltar">
                            </div>
                            <input id="rua" name="rua" type="hidden">
                            <input id="bairro" name="bairro" type="hidden">
                            <input id="cidade" name="cidade" type="hidden">
                            <input id="estado" name="estado" type="hidden">
                        </div>
                    </form>
                </section>
                <section>
                    <div id="sessao2">
                        <div id="resultado">
                
                        </div>
                        <div>
                            <button onclick="enviarForm()" id="sql">Inserir no banco de dados 🔑</button>
                        </div>
                    </div>
                </section>
            </div>



            <div>
                <button onclick="redirecionar2()" id="consulta">Consultar Dados 🔑</button>




            </div>
        
    </main>

    <script>

        function enviarForm() {
            const meuForm = document.getElementById('formulario');
            meuForm.submit();
        }

        let dados = {}

        function redirecionar() {
            window.location.href="../index.php";
        }


        function redirecionar2() {
            window.location.href="consulta.php";
        }


        async function testando(event){

            event.preventDefault();


            const nome = document.getElementById('name').value
            const cep = document.getElementById('cep').value.trim();

            const rua = document.getElementById('rua');
            const bairro = document.getElementById('bairro');
            const cidade = document.getElementById('cidade');
            const estado = document.getElementById('estado');

            const resultado = document.getElementById('resultado');
            

            console.log("nome")


            if (!/^\d{8}$/.test(cep)) {
                resultado.innerHTML = 'CEP inválido! Insira um CEP com 8 dígitos.';
                return;

            }



            try{
                 const response = await fetch(`https://viacep.com.br/ws/${cep}/json`);

                if(!response.ok) throw new Error('Erro na requisição!');

                const data = await response.json();
                
                if (data.erro){
                    resultado.innerHTML = 'Cep não encontrado digite novamente'
                }

                sessao2.style.display = "block"


                 dados = {
                        nome: nome,
                        cep: data.cep,
                        logradouro: data.logradouro,
                        bairro: data.bairro,
                        cidade: data.localidade,
                        estado: data.uf
                    };

                console.log(dados)

                resultado.innerHTML = `
                    <p><strong>Nome do lugar:</strong> ${nome}</p>
                    <p><strong>CEP:</strong> ${data.cep}</p>
                    <p><strong>Logradouro:</strong> ${data.logradouro}</p>
                    <p><strong>Bairro:</strong> ${data.bairro}</p>
                    <p><strong>Cidade:</strong> ${data.localidade}</p>
                    <p><strong>Estado:</strong> ${data.uf}</p>
                    `;

                    rua.value = data.logradouro;
                    bairro.value = data.bairro;
                    cidade.value = data.localidade;
                    estado.value = data.uf;

            }catch(error){
                resultado.innerHTML = `Erro: ${error.message}`;


            }

        }

        async function sql(){
            try{
                const response = await fetch("/serverside/controllers/produtos/ajax-insert-destiny.php", {
                method: "POST", // Método HTTP
                body: JSON.stringify(dados), // Corpo da requisição
                headers: {
                "Content-Type": "application/json; charset=UTF-8" // Cabeçalhos
                }
                });

                const result = await response.json();
                console.log(result)
            }catch (error) {
                // Trata possíveis erros
                console.error("Erro:", error);
            }
       
        }





        document.getElementById('botao').addEventListener('click',testando);
        document.getElementById('sql').addEventListener('click',sql);







        

    </script>

</body>
</html>
