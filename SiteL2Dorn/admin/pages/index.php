<?php

require('private/classes/classIndex.php');

$countNews = Index::countNews(); $countNews = intval($countNews[0]['quant']);
$countBanners = Index::countBanners(); $countBanners = intval($countBanners[0]['quant']);
$countGallery = Index::countGallery(); $countGallery = intval($countGallery[0]['quant']);
$countAccounts = Index::countAccounts(); $countAccounts = intval($countAccounts[0]['quant']);
$countChars = Index::countChars(); $countChars = intval($countChars[0]['quant']);
$countOnline = Index::countOnline(); $countOnline = intval($countOnline[0]['quant']);
$countClans = Index::countClans(); $countClans = intval($countClans[0]['quant']);

for($i=1, $c=12; $i <= $c; $i++) {
	$reais[$i] = 0;
	$dolares[$i] = 0;
	$euros[$i] = 0;
	$pendentes[$i] = 0;
	$concluidas[$i] = 0;
	$canceladas[$i] = 0;
}

$mes = 0; $inReais = 0; $inDolares = 0; $inEuros = 0; $percentReais = 0; $percentDolares = 0; $percentEuros = 0; $countPendentes = 0; $countConcluidas = 0; $countCanceladas = 0; $percentPendentes = 0; $percentConcluidas = 0; $percentCanceladas = 0;

$donateYear = isset($_GET['donateYear']) ? intval($_GET['donateYear']) : date('Y');
$perBegin = mktime(0, 0, 0, 1, 1, $donateYear);
$perEnd = mktime(23, 59, 59, 12, 31, $donateYear);

$donateMov = Index::donates($perBegin, $perEnd);
if(count($donateMov) > 0) {
	
	for($i=0, $c=count($donateMov); $i < $c; $i++) {
		
		$mes = intval(date('m', $donateMov[$i]['data']));
		
		if($donateMov[$i]['status'] == '3' || $donateMov[$i]['status'] == '4') {
		
			$curr = trim($donateMov[$i]['currency']);
			$valor = trim($donateMov[$i]['valor']);
			
			if($curr == 'BRL') { $reais[$mes] += $valor; $inReais += 1; }
			if($curr == 'USD') { $dolares[$mes] += $valor; $inDolares += 1; }
			if($curr == 'EUR') { $euros[$mes] += $valor; $inEuros += 1; }
			
			$countConcluidas += 1;
			$concluidas[$mes] += 1;
			
		} else if($donateMov[$i]['status'] == '2') {
			
			$countCanceladas += 1;
			$canceladas[$mes] += 1;
			
		} else {
			
			$countPendentes += 1;
			$pendentes[$mes] += 1;
			
		}
		
	}
	
}

if($countConcluidas > 0) {
	$percentReais = round($inReais * 100 / $countConcluidas, 1);
	$percentDolares = round($inDolares * 100 / $countConcluidas, 1);
	$percentEuros = round($inEuros * 100 / $countConcluidas, 1);
}

if(count($donateMov) > 0) {
	$percentPendentes = round($countPendentes * 100 / count($donateMov), 1);
	$percentConcluidas = round($countConcluidas * 100 / count($donateMov), 1);
	$percentCanceladas = round($countCanceladas * 100 / count($donateMov), 1);
}

$beginDonateYear = Index::beginDonateYear(); if(!empty($beginDonateYear[0]['data'])) { $beginDonateYear = date('Y', $beginDonateYear[0]['data']); } else { $beginDonateYear = date('Y'); }

?>

<section class="content-header">
	<h1>
		Dashboard <small>Version 3.0</small>
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-home"></i> Home</li>
		<li class="active">Dashboard</li>
	</ol>
</section>

<section class="content">
	
	<div class="row">
		
		<div class="col-lg-4 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?php echo $countNews; ?></h3>
					<p>Notícias</p>
				</div>
				<div class="icon">
					<i class="ion ion-ios-paper"></i>
				</div>
				<a href="?page=list&module=news" class="small-box-footer">Gerenciar <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		
		<div class="col-lg-4 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $countBanners; ?></h3>
					<p>Banners</p>
				</div>
				<div class="icon">
					<i class="ion ion-easel"></i>
				</div>
				<a href="?page=list&module=banners" class="small-box-footer">Gerenciar <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		
		<div class="col-lg-4 col-xs-6">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?php echo $countGallery; ?></h3>
					<p>Galeria</p>
				</div>
				<div class="icon">
					<i class="ion ion-images"></i>
				</div>
				<a href="?page=list&module=gallery" class="small-box-footer">Gerenciar <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-lock"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Accounts</span>
					<span class="info-box-number"><?php echo $countAccounts; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Personagens</span>
					<span class="info-box-number"><?php echo $countChars; ?></span>
				</div>
			</div>
		</div>
	
		<!-- fix for small devices only -->
		<div class="clearfix visible-sm-block"></div>
	
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Online</span>
					<span class="info-box-number"><?php echo $countOnline; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="ion ion-ribbon-b"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Clans</span>
					<span class="info-box-number"><?php echo $countClans; ?></span>
				</div>
			</div>
		</div>
	</div>

	
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">
						Gráficos de Doações
						<select style='display:inline-block;' onchange='javascript:document.location.href="?donateYear="+this.value;'>
							<?php
							for($i=date('Y'), $c=$beginDonateYear; $i >= $c; $i--) {
								echo "<option value='".$i."'".($donateYear == $i ? " selected" : "").">".$i."</option>";
							}
							?>
						</select>
					</h3>
					<div style='float:right;'>
						<a href='?page=list_relat&module=donate' class='btn btn-default'>Ver relatório &raquo;</a>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<p class="text-center">
								<strong>Valor movimentado</strong>
							</p>
							<div class="chart">
								<canvas id="valChart" style="height: 180px;"></canvas>
							</div>
							<div class="box-footer">
								<div class="row">
									<div class="col-xs-4 text-center" style="border-right: 1px solid #dbdbdb" title="<?php echo $percentReais; ?>% das doações foram pagas em reais">
										<input type="text" class="knob" data-readonly="true" value="<?php echo $percentReais; ?>" data-width="80" data-height="80" data-fgColor="#4f98c3">
										<div class="knob-label">
											% Reais (R$)
											<div style='font-size:12px;font-weight:bold;'><?php echo $inReais; ?> doações</div>
										</div>
									</div>
									<div class="col-xs-4 text-center" style="border-right: 1px solid #dbdbdb" title="<?php echo $percentDolares; ?>% das doações foram pagas em dólar">
										<input type="text" class="knob" data-readonly="true" value="<?php echo $percentDolares; ?>" data-width="80" data-height="80" data-fgColor="#00a65a">
										<div class="knob-label">
											% Dolares ($)
											<div style='font-size:12px;font-weight:bold;'><?php echo $inDolares; ?> doações</div>
										</div>
									</div>
									<div class="col-xs-4 text-center" title="<?php echo $percentEuros; ?>% das doações foram pagas em euro">
										<input type="text" class="knob" data-readonly="true" value="<?php echo $percentEuros; ?>" data-width="80" data-height="80" data-fgColor="#dd4b39">
										<div class="knob-label">
											% Euros (€)
											<div style='font-size:12px;font-weight:bold;'><?php echo $inEuros; ?> doações</div>
										</div>
									</div>
				
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<p class="text-center">
								<strong>Quantidade de doações</strong>
							</p>
							<div class="chart">
								<canvas id="quantChart" style="height: 180px;"></canvas>
							</div>
							<div class="box-footer">
								<div class="row">
									<div class="col-xs-4 text-center" style="border-right: 1px solid #dbdbdb">
										<input type="text" class="knob" data-readonly="true" value="<?php echo $percentPendentes; ?>" data-width="80" data-height="80" data-fgColor="#4f98c3">
										<div class="knob-label">
											% Pendente
											<div style='font-size:12px;font-weight:bold;'><?php echo $countPendentes; ?> doações</div>
										</div>
									</div>
									<div class="col-xs-4 text-center" style="border-right: 1px solid #dbdbdb">
										<input type="text" class="knob" data-readonly="true" value="<?php echo $percentConcluidas; ?>" data-width="80" data-height="80" data-fgColor="#00a65a">
										<div class="knob-label">
											% Concluída
											<div style='font-size:12px;font-weight:bold;'><?php echo $countConcluidas; ?> doações</div>
										</div>
									</div>
									<div class="col-xs-4 text-center">
										<input type="text" class="knob" data-readonly="true" value="<?php echo $percentCanceladas; ?>" data-width="80" data-height="80" data-fgColor="#dd4b39">
										<div class="knob-label">
											% Cancelada
											<div style='font-size:12px;font-weight:bold;'><?php echo $countCanceladas; ?> doações</div>
										</div>
									</div>
				
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- ChartJS 1.0.1 -->
<script src="layout/plugins/chartjs/Chart.min.js"></script>

<!-- jQuery Knob Chart -->
<script src="layout/plugins/knob/jquery.knob.js"></script>

<script>
	$(function () {
		
		"use strict";
		
		$(".knob").knob();
		
		var chartValores = $("#valChart").get(0).getContext("2d");
		var valChart = new Chart(chartValores);
		
		var valChartData = {
			labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
			datasets: [
			{
				label: "R$",
				fillColor: "rgba(60,141,188,0.5)",
				strokeColor: "rgba(60,141,188,0.8)",
				pointColor: "#3b8bba",
				pointStrokeColor: "rgba(60,141,188,0.8)",
				pointHighlightFill: "#004d7a",
				pointHighlightStroke: "#004d7a",
				data: [<?php echo $reais[1].", ".$reais[2].", ".$reais[3].", ".$reais[4].", ".$reais[5].", ".$reais[6].", ".$reais[7].", ".$reais[8].", ".$reais[9].", ".$reais[10].", ".$reais[11].", ".$reais[12]; ?>]
			},
			{
				label: "$",
				fillColor: "rgba(0,189,102,0.5)",
				strokeColor: "rgba(0,172,93,0.8)",
				pointColor: "#00a65a",
				pointStrokeColor: "rgba(0,122,66,0.8)",
				pointHighlightFill: "#006034",
				pointHighlightStroke: "#006034",
				data: [<?php echo $dolares[1].", ".$dolares[2].", ".$dolares[3].", ".$dolares[4].", ".$dolares[5].", ".$dolares[6].", ".$dolares[7].", ".$dolares[8].", ".$dolares[9].", ".$dolares[10].", ".$dolares[11].", ".$dolares[12]; ?>]
			},
			{
				label: "€",
				fillColor: "rgba(221,75,57,0.5)",
				strokeColor: "rgba(221,75,57,0.8)",
				pointColor: "#dd4b39",
				pointStrokeColor: "rgba(221,75,57,0.8)",
				pointHighlightFill: "#941000",
				pointHighlightStroke: "#941000",
				data: [<?php echo $euros[1].", ".$euros[2].", ".$euros[3].", ".$euros[4].", ".$euros[5].", ".$euros[6].", ".$euros[7].", ".$euros[8].", ".$euros[9].", ".$euros[10].", ".$euros[11].", ".$euros[12]; ?>]
			}
			]
		};
	
		var valChartOptions = {
			showScale: true,
			scaleShowGridLines: true,
			scaleGridLineColor: "rgba(0,0,0,.1)",
			scaleGridLineWidth: 1,
			scaleShowHorizontalLines: true,
			scaleShowVerticalLines: true,
			bezierCurve: true,
			bezierCurveTension: 0.3,
			pointDot: true,
			pointDotRadius: 4,
			pointDotStrokeWidth: 1,
			pointHitDetectionRadius: 20,
			datasetStroke: true,
			datasetStrokeWidth: 2,
			datasetFill: true,
			legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
			tooltipTemplate: "<%=label%>: <%=datasetLabel%> <%= value %>",
			multiTooltipTemplate: "<%=datasetLabel%> <%= value %>",
			maintainAspectRatio: true,
			responsive: true
		};
	
		valChart.Line(valChartData, valChartOptions);
		
		
		
		
		
		var chartQuant = $("#quantChart").get(0).getContext("2d");
		var quantChart = new Chart(chartQuant);
	
		var quantChartData = {
			labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
			datasets: [
			{	
				label: "Pendentes",
				fillColor: "rgba(60,141,188,0.5)",
				strokeColor: "rgba(60,141,188,0.8)",
				pointColor: "#3b8bba",
				pointStrokeColor: "rgba(60,141,188,0.8)",
				pointHighlightFill: "#004d7a",
				pointHighlightStroke: "#004d7a",
				data: [<?php echo $pendentes[1].", ".$pendentes[2].", ".$pendentes[3].", ".$pendentes[4].", ".$pendentes[5].", ".$pendentes[6].", ".$pendentes[7].", ".$pendentes[8].", ".$pendentes[9].", ".$pendentes[10].", ".$pendentes[11].", ".$pendentes[12]; ?>]
			},
			{	
				label: "Concluídas",
				fillColor: "rgba(0,189,102,0.5)",
				strokeColor: "rgba(0,172,93,0.8)",
				pointColor: "#00a65a",
				pointStrokeColor: "rgba(0,122,66,0.8)",
				pointHighlightFill: "#006034",
				pointHighlightStroke: "#006034",
				data: [<?php echo $concluidas[1].", ".$concluidas[2].", ".$concluidas[3].", ".$concluidas[4].", ".$concluidas[5].", ".$concluidas[6].", ".$concluidas[7].", ".$concluidas[8].", ".$concluidas[9].", ".$concluidas[10].", ".$concluidas[11].", ".$concluidas[12]; ?>]
			},
			{	
				label: "Canceladas",
				fillColor: "rgba(221,75,57,0.5)",
				strokeColor: "rgba(221,75,57,0.8)",
				pointColor: "#dd4b39",
				pointStrokeColor: "rgba(221,75,57,0.8)",
				pointHighlightFill: "#941000",
				pointHighlightStroke: "#941000",
				data: [<?php echo $canceladas[1].", ".$canceladas[2].", ".$canceladas[3].", ".$canceladas[4].", ".$canceladas[5].", ".$canceladas[6].", ".$canceladas[7].", ".$canceladas[8].", ".$canceladas[9].", ".$canceladas[10].", ".$canceladas[11].", ".$canceladas[12]; ?>]
			}
			]
		};
	
		var quantChartOptions = {
			showScale: true,
			scaleShowGridLines: true,
			scaleGridLineColor: "rgba(0,0,0,.1)",
			scaleGridLineWidth: 1,
			scaleShowHorizontalLines: true,
			scaleShowVerticalLines: true,
			bezierCurve: true,
			bezierCurveTension: 0.3,
			pointDot: true,
			pointDotRadius: 4,
			pointDotStrokeWidth: 1,
			pointHitDetectionRadius: 20,
			datasetStroke: true,
			datasetStrokeWidth: 2,
			datasetFill: true,
			legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
			tooltipTemplate: "<%=label%>: <%=datasetLabel%>: <%= value %>",
			multiTooltipTemplate: "<%=datasetLabel%>: <%= value %>",
			maintainAspectRatio: true,
			responsive: true
		};
	
		quantChart.Line(quantChartData, quantChartOptions);
		
		
	});
</script>

