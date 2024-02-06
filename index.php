<?php
    require_once __DIR__ . '/infra/middlewares/middleware-not-authenticated.php';
    require_once 'setupdatabase.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Movie Break</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="pages/landing/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <header>
        <div class="nav-container">
            <img id="logo" src="pages/assets/image.png" alt="Logo da Movie Break">
            <div class="btns-nav">
                <a href="./pages/public/signin.php" class="login-botao">Iniciar Sessão</a>
            </div>
        </div>
    </header>


    <section class="hero">
        <h1>Gere e desfruta de filmes e séries de alta qualidade agora mesmo!</h1>
        <p>Queres começar? Cliqua no botão abaixo.</p>
        <a href="./pages/public/signup.php" class="cta-button">Registar Agora</a>
    </section>

    <div class="separador"></div>

    <section class="filme-section">
        <div class="conteudo">
            <div class="row align-items-center">

                <div class="col-lg-6 image ">
                    <div class="section__wrapper animation-text margin-top-10">
                        <div class="h-auto w-100 text-center mb-5">
                            <img src="pages/assets/pc.png" alt="PC" class="object-fit-cover w-100 ">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 text-start">
                    <h1 class="left-align">
                        Objetivos
                    </h1>
                    <p class="texto-formatado">
                        Bem-vindo ao Movie Break!
                        Esta é a nossa aplicação de gestão de filmes e séries!
                        Aqui, podes criar o teu perfil, categorizar, compartilhar,
                        agendar e adicionar notas aos seus títulos favoritos.
                        Explore e descubra um mundo de entretenimento de forma colaborativa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="separador"></div>

    <section class="filme-section1">
        <div class="conteudo">
            <div class="row align-items-center">
                <div class="col-lg-6 text-start">
                    <h1 class="left-align">
                        Sobre Nós
                    </h1>
                    <p class="texto-formatado">
                        Somos um grupo de estudantes do IPVC que partilha a paixão
                        por criar uma experiência única para os amantes do entretenimento.
                        A nossa missão é simplificar e enriquecer a forma como as pessoas descobrem,
                        assistem e partilham as suas filmes e séries favoritos.
                    </p>
                </div>
                <div class="col-lg-6 image">
                    <div class="section__wrapper animation-text margin-top-10">
                        <div class="h-auto w-100 text-center mb-5">
                            <img src="pages/assets/aboutus.png" alt="aboutus" class="object-fit-cover w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="separador"></div>

    <section class="filme-section">
        <div class="conteudo">
            <div class="row align-items-center">

                <div class="col-lg-6 image ">
                    <div class="section__wrapper animation-text margin-top-10">
                        <div class="h-auto w-100 text-center mb-5">
                            <img src="pages/assets\contacta.png" alt="Contacta" class="object-fit-cover w-100 ">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 text-start">
                    <h1 class="left-align">
                        Contactem-nos
                    </h1>
                    <p class="texto-formatado">
                        Estamos aqui para te ajudar e responder a todas as tuas perguntas. Não hesites em entrar em contato
                        connosco,
                        seja para obter suporte, relatar problemas ou fornecer feedback. A tua opinião é importante para
                        nós!
                        Qualquer dúvida envie um email para <u>josefaus@ipvc.pt</u>.
                        Obrigado!
                    </p>

                    <br>

                
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="separador"></div>

    <section class="filme-section2 text-center">
        <div class="conteudo">
            <div class="row align-items-center">
                <div class="col-lg-6 mx-auto">
                    <br>
                    <h1 class="left-align ">Perguntas Frequentes</h1>
                    <br>
                    <ul class="faq-list">
                        <li>
                            <div class="question" onclick="toggleAnswer('answer1')">O que é o MovieBreak?</div>
                            <div class="answer" id="answer1">
                                O MovieBreak é uma aplicação online para partilhar filmes e séries. Criamos recursos para
                                melhorar a experiência dos utilizadores ao organizar, descobrir e partilhar conteúdos
                                audiovisuais.
                            </div>
                        </li>
                        <br>
                        <li>
                            <div class="question" onclick="toggleAnswer('answer2')">São quantos membros?</div>
                            <div class="answer" id="answer2">Atualmente, o "MovieBreak" conta com uma comunidade vibrante
                                de mais de 10000 membros entusiastas de filmes e séries. A plataforma tem experienciado um
                                crescimento constante desde o seu lançamento, com utilizadores de todas as partes do mundo
                                que se ligam entre si para compartilhar as suas recomendações, avaliações e descobertas
                                cinematográficas</div>
                        </li>
                        <br>
                        <li>
                            <div class="question" onclick="toggleAnswer('answer3')">Como sou informado sobre atualizações e
                                novos recursos?</div>
                            <div class="answer" id="answer3">Siga as contas oficiais do "MovieBreak" nas principais redes
                                sociais, como Facebook, Twitter, Instagram, e outras que possam ser relevantes.</div>
                        </li>
                        <br>
                        <li>
                            <div class="question" onclick="toggleAnswer('answer4')">Quem são os fundadores da empresa?</div>
                            <div class="answer" id="answer4">Os fundadores são José Faus e Tiago Afonso.</div>
                        </li>
                        <br>
                        <li>
                            <div class="question" onclick="toggleAnswer('answer5')">Com que frequência vocês lançam
                                atualizações?
                            </div>
                            <div class="answer" id="answer5">A equipa dedicada por de trás do desenvolvimento do software
                                orgulha-se de oferecer novos recursos e melhorias a cada duas semanas.</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <div class="separador"></div>

    <footer>
        <p>© 2023 Movie Break. Todos os direitos reservados.</p>
        <div class="redes-sociais">
            <a href="https://www.facebook.com/moviebreakdotde"><img src="pages/assets/facebook.png" alt="Facebook"></a>
            <a href="https://github.com/Faus11/SIR-TP1"><img src="pages/assets/github.png" alt="Twitter"></a>
            <a href="https://www.instagram.com/josefaus_03/"><img src="pages/assets/instagram.png" alt="Instagram"></a>
        </div>
        <div class="termos-e-condicoes">
            <p><a href="caminho-para-os-termos-e-condicoes.html"> •Termos e Condições</a></p>
            <p><a href="caminho-para-os-termos-e-condicoes.html"> •Política de Privacidade</a></p>


    </footer>

    <script src="forms.js"></script>
</body>

</html>