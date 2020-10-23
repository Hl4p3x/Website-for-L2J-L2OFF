<?php

###########################################################
##                   Configurações                       ##
###########################################################
$server_name = 'L 2 ORIGINS'; // Nome do servidor
$server_chronicle = 'Interlude'; // Crônica do servidor
$server_url = ''; // Digite exatamente o URL onde se encontra este site (exemplo: www.l2server.com)


###########################################################
##                   Banco de dados                      ##
###########################################################

# Qual método de conexão você irá utilizar? (recomendamos MySQLi ou PDO-MySQL)
$conMethod = 3; // 1 = MySQL, 2 = MySQLi, 3 = PDO-MySQL

$host = ''; // Endereço do host
$dbnm = ''; // Nome do banco
$user = ''; // Usuário
$pass = ''; // Senha

###########################################################
##                    Server Status                      ##
###########################################################
$serverIp = ''; // IP do DB (para buscar o status do servidor)
$loginPort = '2106'; // porta do login/auth
$gamePort = '7777'; // porta do game

// Forçar o site a exibir um certo status (on = Online | off = Offline | auto = Status Real)
$forceLoginStatus = 'auto'; // Auth Status (Padrão: auto)
$forceGameStatus = 'auto'; // Game Status (Padrão: auto)


###########################################################
##              Atualstudio Web Admin 3.0                ##
###########################################################
$admpass = 'pison@88'; // Senha do painel admin


###########################################################
##               Configurações de e-mail                 ##
###########################################################
$admin_email = 'pison_157@hotmail.com'; // Endereço de e-mail que os jogadores podem utilizar para entrar em contato
$server_email = 'pison_157@hotmail.com'; // Seu endereço de e-mail utilizado para enviar e-mails automáticos (exemplo: nao-responda@seuservidor.com)
$vcmemail = 1; // É permitido criar várias contas com um mesmo endereço de e-mail? (1 = Sim | 0 = Não)
$cofemail = 0; // Ao criar conta é necessário confirmar e-mail? (1 = Sim | 0 = Não)
$chaemail = 1; // Os jogadores podem alterar o endereço de e-mail de suas contas? (1 = Sim | 0 = Não)
$chaemail_confirm = 0; // Para alterar o endereço de e-mail é necessário confirmar? Se sim, será enviado um e-mail para o endereço de e-mail atual solicitando confirmação. Caso a conta não possua endereço de e-mail, essa opção será ignorada (1= Sim | 0 = Não)

# SMTP:
$useSMTP = 0; // Enviar e-mails via SMTP? (1 = Sim | 0 = Não)
$SMTP_host = 'smtp.seusite.com'; // Endereço do Host do SMTP
$SMTP_port = 587; // Porta de conexão para a saída de e-mails (consulte seu host, mas geralmente é 587 ou 465)
$SMTP_secu = 'ssl'; // Qual protocolo de segurança? ssl ou tls?
$SMTP_user = 'no-reply@l2server.com'; // Usuário de autenticação do SMTP (geralmente o e-mail remetente)
$SMTP_pass = 'emailpass'; // Senha de autenticação do SMTP (geralmente a senha do e-mail remetente)


###########################################################
##                        Captcha                        ##
###########################################################
// O captcha é um gerador de códigos que são obrigatórios o preenchimento ao se registrar, logar no painel admin e etc.
$captcha_register_on = 1; // Captcha no formulário de registro (1 = Sim | 0 = Não)
$captcha_cp_on = 1; // Captcha ao logar no painel de controle do usuário (1 = Sim | 0 = Não)
$captcha_forgotpass_on = 1; // Captcha ao enviar pedido de recuperação de conta para e-mail (1 = Sim | 0 = Não)


###########################################################
##                     Diretórios                        ##
###########################################################
$dir_gallery = 'imgs/gallery/'; // Diretório das imagens da galeria
$dir_banners = 'imgs/banners/'; // Diretório das imagens dos banners
$dir_newsimg = 'imgs/news/'; // Diretório das imagens das notícias


###########################################################
##                 Contagem regressiva                   ##
###########################################################
$counterActived = 1; // Ativar contagem regressiva na página inicial? (1 = Sim | 0 = Não)
$cDia = '22'; // Dia
$cMes = '06'; // Mês
$cAno = '2019'; // Ano
$cHor = '19'; // Hora
$cMin = '00'; // Minuto
$cGMT = '-3'; // GMT/UTC
$sumH = 0; // Caso a hora esteja sendo exibida incorretamente, acrescente ou diminua o valor aqui (ex: caso precise diminuir 2 hrs, insira "-2", caso precise acrescentar 3, insira "3" (sem +)


###########################################################
##                  Cadastro de Contas                   ##
###########################################################
$suffixActive = 1; // Ativar sufixo no login? (método de segurança que acrescenta 3 valores aleatórios no login do usuário, para evitar roubo de contas através de listas de logins com senhas que outros admins possuem) (1 = Sim | 0 = Não)
$forceSuffix = 0; // O sufixo é obrigatório? (1 = Sim | 0 = Não) (Se definir '0', os usuários terão a opção "não quero isso" que ignora o sufixo)
$downRegfile = 1; // Download de arquivo TXT após cadastro bem sucedido? (1 = Sim | 0 = Não)
$passRegfile = 1; // Exibir senha no arquivo TXT gerado após cadastro bem sucedido? (1 = Sim | 0 = Não)

# Data de liberação do cadastro (antes dessa data não será possível criar contas) - Caso queira desabilitar, basta inserir uma data que já passou.
$reg['dia'] = '5'; // Dia
$reg['mes'] = '12'; // Mês
$reg['ano'] = '1991'; // Ano
$reg['hr'] = '23'; // Hora
$reg['min'] = '59'; // Minuto


###########################################################
##            Controle de exibição de páginas            ##
###########################################################
// Quais páginas estão disponíveis para acesso? (1 = Disponível | 0 = Indisponível)
$dpage['bosstt'] = 1; // Boss Status
$dpage['bossjl'] = 1; // Boss Jewelry Location
$dpage['galler'] = 1; // Galeria
$dpage['olyall'] = 1; // Olympiad - Histórico de heroes
$dpage['olyher'] = 1; // Olympiad - Heroes atuais
$dpage['olyrak'] = 1; // Olympiad - Ranking
$dpage['csiege'] = 1; // Castle & Siege
$dpage['topcla'] = 1; // Top Clan
$dpage['toponl'] = 1; // Top Online
$dpage['toppkp'] = 1; // Top Pk
$dpage['toppvp'] = 1; // Top PvP
$dpage['unstuk'] = 1; // Unstuck


###########################################################
##                 Rankings e Exibições                  ##
###########################################################
$cacheDelayMin = 3; // Intervalo em minutos que os caches de rankings são atualizados. Ex: se inserir '1' os rankings do site serão atualizados a cada 1 minuto
$countTopPVP = 50; // Quantidade de jogadores no Top PvP
$countTopPK = 50; // Quantidade de jogadores no Top PK
$countTopON = 50; // Quantidade de jogadores no Top Online
$countTopCLAN = 10; // Quantidade de clans no Top Clan
$galleryMax = 30; // Quantidade de imagens/vídeos exibidos em cada página da galeria
$galleCount = 6; // Quantidade de imagens/videos exibidos na galeria na lateral do site
$inewsCount = 3; // Quantidade de notícias na página inicial do site
$showPlayersOn = 1; // Exibir quantidade de jogadores online? (1 = Sim | 0 = Não)
$fakePlayers = 1.0; // Multiplicação da quantidade de jogadores online. A quantidade de jogadores online será multiplicada pelo valor inserido aqui. (1.0 = Quantidade real / 1.5 = multiplicado por 1,5 / 2.0 = multiplicado por 2...) - IMPORTANTE: INSIRA PONTO AO INVÉS DE VÍRGULA
$olyExibPoint = 1; // Ranking da Grand Olympiad deve exibir os pontos dos jogadores? (1 = Sim | 0 = Não)
$showRankReg = 1; // Exibir rankings antes da data de liberação do cadastro? (1 = Sim | 0 = Não)
$bossJwlIds = "29019,6657,6658,6659,6660,6661,8191"; // IDs das Boss Jewels (Baium Ring, Antharas Earring, etc)


###########################################################
##                      Facebook                         ##
###########################################################
$facePopupOn = 1; // Exibir popup do Facebook? (1 = Sim | 0 = Não)
$fbPopupDelay = 0; // De quantos em quantos dias o popup deve aparecer novamente? Ex: Se setar 1 ele aparecerá todo dia
$faceBoxOn = 1; // Exibir box do Facebook na página inicial? (1 = Sim | 0 = Não)
$facePage = 'https://www.facebook.com/L2originsnet-306786793449945/?modal=admin_todo_tour'; // Página no Facebook


###########################################################
##              Página de Doações Pública                ##
###########################################################
$coinName = 'Ticket Donate'; // Nome do item donate
$coinPer = '1'; // Quantidade de coins
$coinCur = 'R$'; // Moeda dessa quantidade
$coinCos = '1.00'; // Valor dessa quantidade


###########################################################
##                Outras Configurações                   ##
###########################################################

$defaultLang = 'EN'; // Idioma padrão do site (Escolha entre: PT, EN ou ES) - O site conta com um sistema inteligente que detecta o idioma do navegador do usuário e exibe tudo naquele idioma, mas caso não consigamos detectar ou caso o navegador esteja num idioma diferente dos três citados anteriormente, o idioma setado aqui será o exibido

$gmt = '0'; // Se os scripts do site estiverem num horário adiantado ou atrasado, altere o GMT. Exemplo: -1 (-1 hora), +3 (+3 horas), etc

$bannerDelay = 10; // De quantos em quantos segundos os banners na página inicial se revesam?

// Locs X, Y e Z utilizados no 'unstuck' do painel de usuário
$unstuck_loc_x = '83257'; // Padrão: 83257
$unstuck_loc_y = '149058'; // Padrão: 149058
$unstuck_loc_z = '-3400'; // Padrão: -3400
