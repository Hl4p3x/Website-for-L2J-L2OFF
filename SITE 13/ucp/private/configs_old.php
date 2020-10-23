<?php

###########################################################
##                   Configurações                       ##
###########################################################
$server_name = 'L2Server'; // Nome do servidor
$server_chronicle = 'Chronicle'; // Crônica do servidor
$server_url = 'www.l2server.com'; // Digite exatamente o URL do site (exemplo: www.l2server.com)
$panel_url = 'www.l2server.com/ucp'; // Digite exatamente o URL onde se encontra este painel (exemplo: www.l2server.com/ucp)


###########################################################
##                   Banco de dados                      ##
###########################################################

# Qual método de conexão você irá utilizar? (recomendamos MySQLi ou PDO-MySQL)
$conMethod = 2; // 1 = MySQL, 2 = MySQLi, 3 = PDO-MySQL

$host = 'localhost'; // Endereço do host
$dbnm = 'l2jdb'; // Nome do banco
$user = 'root'; // Usuário
$pass = 'root'; // Senha


###########################################################
##              Atualstudio Web Admin 3.0                ##
###########################################################
$admpass = 'mudar123'; // Senha do painel admin


###########################################################
##               Configurações de e-mail                 ##
###########################################################
$server_email = 'no-reply@l2server.com'; // Seu endereço de e-mail utilizado para enviar e-mails automáticos (exemplo: nao-responda@seuservidor.com)
$vcmemail = 1; // É permitido criar várias contas com um mesmo endereço de e-mail? (1 = Sim | 0 = Não)
$cofemail = 0; // Ao criar conta é necessário confirmar e-mail? (1 = Sim | 0 = Não)
$chaemail = 1; // Os jogadores podem alterar o endereço de e-mail de suas contas? (1 = Sim | 0 = Não)
$chaemail_confirm = 1; // Para alterar o endereço de e-mail é necessário confirmar? Se sim, será enviado um e-mail para o endereço de e-mail atual solicitando confirmação. Caso a conta não possua endereço de e-mail, essa opção será ignorada (1 = Sim | 0 = Não)

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
$captcha_cp_on = 1; // Captcha ao logar no painel (1 = Sim | 0 = Não)
$captcha_forgotpass_on = 1; // Captcha ao enviar pedido de recuperação de conta para e-mail (1 = Sim | 0 = Não)


###########################################################
##                  Cadastro de Contas                   ##
###########################################################
$suffixActive = 1; // Ativar sufixo no login? (método de segurança que acrescenta 3 valores aleatórios no login do usuário, para evitar roubo de contas através de listas de logins com senhas que outros admins possuem) (1 = Sim | 0 = Não)
$forceSuffix = 0; // O sufixo é obrigatório? (1 = Sim | 0 = Não) (Se definir '0', os usuários terão a opção "não quero isso" que ignora o sufixo)
$downRegfile = 1; // Download de arquivo TXT após cadastro bem sucedido? (1 = Sim | 0 = Não)
$passRegfile = 1; // Exibir senha no arquivo TXT gerado após cadastro bem sucedido? (1 = Sim | 0 = Não)

# Data de liberação do cadastro (antes dessa data não será possível criar contas) - Caso queira desabilitar, basta inserir uma data que já passou.
$reg['dia'] = '31'; // Dia
$reg['mes'] = '12'; // Mês
$reg['ano'] = '2015'; // Ano
$reg['hr'] = '23'; // Hora
$reg['min'] = '59'; // Minuto


###########################################################
##                 Rankings e Exibições                  ##
###########################################################
$cacheDelayMin = 3; // Intervalo em minutos que os caches de rankings são atualizados. Ex: se inserir '1' os rankings do painel serão atualizados a cada 1 minuto
$countTopPVP = 100; // Quantidade de jogadores no Top PvP
$countTopPK = 100; // Quantidade de jogadores no Top PK
$countTopON = 100; // Quantidade de jogadores no Top Online
$countTopCLAN = 50; // Quantidade de clans no Top Clan
$olyExibPoint = 1; // Ranking da Grand Olympiad deve exibir os pontos dos jogadores? (1 = Sim | 0 = Não)
$showRankReg = 1; // Exibir rankings antes da data de liberação do cadastro? (1 = Sim | 0 = Não)


###########################################################
##                   Cor, GMT e Idioma                   ##
###########################################################
$themeColor = 'default'; // Qual a tonalidade de cor predominante na template? (Escolha: default, black, blue, red, green ou purple)
$defaultLang = 'EN'; // Idioma padrão do painel (Escolha entre: PT, EN ou ES) - O painel conta com um sistema inteligente que detecta o idioma do navegador do usuário e exibe tudo naquele idioma, mas caso não consigamos detectar ou caso o navegador esteja num idioma diferente dos três citados anteriormente, o idioma setado aqui será o exibido
$gmt = '0'; // Se os scripts do painel estiverem num horário adiantado ou atrasado, altere o GMT. Exemplo: -1 (-1 hora), +3 (+3 horas), etc


###########################################################
##              Controle de funcionalidades              ##
###########################################################
// Quais funcionalidades estão disponíveis para os jogadores? (1 = Disponível | 0 = Indisponível)
$funct['regist'] = 1; // Se cadastrar através do painel
$funct['forgot'] = 1; // Recuperar conta através do painel
$funct['donate'] = 1; // Fazer doações/adquirir moedas
$funct['trnsf1'] = 1; // Transferir moedas online para um personagem in-game - Possibilita converter seu saldo para coins/ticket in-game (mais configurações abaixo)
$funct['trnsf2'] = 1; // Transferir moedas online para outra conta
$funct['gamst1'] = 1; // Game Stats - Top PvP
$funct['gamst2'] = 1; // Game Stats - Top PK
$funct['gamst3'] = 1; // Game Stats - Top Clan
$funct['gamst4'] = 1; // Game Stats - Top Online
$funct['gamst5'] = 1; // Game Stats - Grand Olympiad
$funct['gamst6'] = 1; // Game Stats - Boss Status
$funct['gamst7'] = 1; // Game Stats - Castle & Siege
$funct['config'] = 1; // Configurações (alterar dados da conta)


###########################################################
##                Cadastro e Recuperação                 ##
###########################################################
// Caso indisponibilize acima as opções de "Se cadastrar através do painel" ou "Recuperar conta através do painel", você pode inserir abaixo links externos para que os jogadores possam se cadastrar ou recuperar suas contas em uma página externa (caso deixe em branco, as opções irão sumir)
$link_regist = "http://opcional"; // Link da página externa de cadastro
$link_forgot = "http://opcional"; // Link da página externa de recuperar


###########################################################
##                  Aquisição de Saldo                   ##
###########################################################
$coinName = 'Online Coin'; // Nome da moeda online que representa o saldo (usada apenas no painel de usuário)
$coinName_mini = 'Coin'; // Nome resumido da moeda

// Bonus em porcentagem ao adquirir moeda online em altas quantidades (Exemplo: a cada 100 moedas compradas, ganha 10%, ou seja, paga pelas 100, mas recebe 110)
$bonusActived = 1; // Deseja habilitar a bonificação por compra em quantidade? (1 = Sim | 0 = Não)

// Você pode inserir até 3 bonificações! Caso não queira usar alguma, basta setar os valores como '0' que será desconsiderada.

// Bonificação 1:
$buyCoins['bonus_count'][1] = '100'; // A partir de qual quantidade o bônus abaixo é dado?
$buyCoins['bonus_percent'][1] = '10'; // Qual a porcentagem de bonificação?

// Bonificação 2:
$buyCoins['bonus_count'][2] = '400'; // A partir de qual quantidade o bônus abaixo é dado?
$buyCoins['bonus_percent'][2] = '15'; // Qual a porcentagem de bonificação?

// Bonificação 3:
$buyCoins['bonus_count'][3] = '1000'; // A partir de qual quantidade o bônus abaixo é dado?
$buyCoins['bonus_percent'][3] = '20'; // Qual a porcentagem de bonificação?

// Exclusão de fatura
$delFatura = 1; // O usuário pode excluir uma fatura? (1 = Sim | 0 = Não) - OBS: Uma fatura nunca é excluída, ela é ocultada, mas sempre permanecerá no banco de dados.


###########################################################
##         Transferência por coin/ticket in-game         ##
###########################################################
// Caso esteja habilitada a funcionalidade "Transferir moedas online para um personagem in-game", o jogador poderá converter seu saldo online para moedas in-game! Precisamos definir algumas informações...
$coinGame = 'Donate Coin'; // Nome da moeda donate in-game (geralmente Coin, Ticket ou Gold)
$coinID = 123456; // ID da moeda


###########################################################
##                   Modulos de doação                   ##
###########################################################

$autoDelivery = 1; // Você deseja que a entrega do saldo seja feita de forma automática? (1 = Sim | 0 = Não) (se optar de forma manual, as doações pagas ficarão com status "Paga". Você terá que ir até o painel admin e concluí-las clicando no botão "Entregar". Quando concluir, o saldo será adicionado e o status passará a ser "Entregue")
$donateEmail = 'seu@email.com'; // Email que receberá os comprovantes de pagamento para as transações bancárias e módulos de confirmação manual

// PAGSEGURO CONFIGS:
$PagSeguro['actived'] = 1; // Opção ativa? (1 = Sim / 0 = Não)
$PagSeguro['email'] = 'seu@email.com'; // Email da conta que receberá as doações
$PagSeguro['token'] = '___TOKEN_AQUI___'; // Token gerado no PagSeguro
$PagSeguro['token_sandbox'] = '___TOKEN_AQUI___'; // Token gerado no ambiente de testes do PagSeguro
$PagSeguro['testando'] = 0; // Está testando o sistema através do PagSeguro Sandbox? (1 = Sim | 0 = Não)
$PagSeguro['coin_price'] = '1.00'; // Valor unitário (em Reais)

// PAYPAL CONFIGS:
$PayPal['actived'] = 1; // Opção ativa? (1 = Sim / 0 = Não)
$PayPal['business_email'] = 'seu@email.com'; // Email da conta que receberá as doações
$PayPal['USD']['coin_price'] = '0.40'; // Valor unitário (em Dolar)
$PayPal['BRL']['coin_price'] = '1.00'; // Valor unitário (em Reais)
$PayPal['EUR']['coin_price'] = '0.30'; // Valor unitário (em Euros)
$PayPal['testando'] = 0; // Está testando o sistema através do PayPal Sandbox? (1 = Sim | 0 = Não)

// MERCADOPAGO CONFIGS:
$MercadoPago['actived'] = 1; // Opção ativa? (1 = Sim / 0 = Não)
$MercadoPago['client_id'] = '___CLIENT_ID___'; // "CLIENT_ID" presente na página https://www.mercadopago.com/mlb/account/credentials?type=basic
$MercadoPago['client_secret'] = '___CLIENT_SECRET___'; // "CLIENT_SECRET" presente na página https://www.mercadopago.com/mlb/account/credentials?type=basic
$MercadoPago['coin_price'] = '1.00'; // Valor unitário (em Reais)
$MercadoPago['testando'] = 0; // Está testando o sistema através do MercadoPago Sandbox? (1 = Sim | 0 = Não)

// TRANSACAO BANCARIA:
$Banking['actived'] = 1; // Opção ativa? (1 = Sim / 0 = Não)
$Banking['currency'] = 'BRL'; // Código da moeda
$Banking['coin_price'] = '1.00'; // Valor unitário
$Banking['bank_dados'] = '
<b>CAIXA ECONÔMICA FEDERAL OU CASAS LOTÉRICAS</b><br />
<b>AGÊNCIA:</b> 0000<br />
<b>OPERAÇÃO:</b> 013<br />
<b>CONTA POUPANÇA:</b> 000-1<br />
<b>TITULAR:</b> ADMIN NAME';
