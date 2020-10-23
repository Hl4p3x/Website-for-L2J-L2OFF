<section class="content-header">
	<h1>
		Adicionar Saldo
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-money"></i> Doações</li>
		<li class="active">Adicionar Saldo</li>
	</ol>
</section>

<section class="content">
	
	<div class="box">
		
		<form method='POST' class='atualstudio usarJquery' action='?engine=balance_change&module=donate'>

			<div class="box-body">
				
				Insira o login da conta e o saldo que deseja inserir na mesma.<br />
				Obs: Se a conta inserida já possuir saldo, ele será substituído pelo novo valor que inserir abaixo.<br /><br />

				<div class='form-group'>
					<label>
						<div class='desc'>Account (Login)</div>
						<input type='text' name='account' maxlength='25' class='form-control' />
					</label>
				</div>

				<div class='form-group'>
					<label>
						<div class='desc'> Saldo (<?php echo strtolower($coinName)."'s"; ?>)</div>
						<input type='text' name='saldo' maxlength='11' class='form-control' />
					</label>
				</div>

				<div class='box-footer'>
					<input type='submit' class='btn btn-primary' value='Adicionar Saldo' />
				</div>

			</div>
			
		</form>
		
	</div>
	
</section>

