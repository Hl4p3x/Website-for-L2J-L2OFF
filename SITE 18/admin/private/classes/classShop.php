<?php

class Shop {

	public static function checkCatNameExists($name, $cat=0) {
		$sql = "SELECT * FROM site_shop_categories WHERE nome = '".$name."' AND scat_id <> '".$cat."' LIMIT 1";
		return DB::Executa($sql);
	}

	public static function findLastCat() {
		$sql = "SELECT ordem FROM site_shop_categories ORDER BY ordem DESC LIMIT 1";
		return DB::Executa($sql);
	}

	public static function insertCat($nome, $ordem, $data) {
		$sql = "INSERT INTO site_shop_categories (nome, ordem, data_c) VALUES ('".$nome."', '".$ordem."', '".$data."')";
		return DB::Executa($sql);
	}

	public static function listCats() {
		$sql = "SELECT * FROM site_shop_categories ORDER BY ordem ASC";
		return DB::Executa($sql);
	}

	public static function findCat($cat) {
		$sql = "SELECT * FROM site_shop_categories WHERE scat_id = '".$cat."' LIMIT 1";
		return DB::Executa($sql);
	}

	public static function deleteCat($cat, $newCat) {

		$execute = DB::Executa("UPDATE site_shop_packs SET scat_id = '".$newCat."' WHERE scat_id = '".$cat."'");
		if(!$execute) { return false; }

		$execute = DB::Executa("DELETE FROM site_shop_categories WHERE scat_id = '".$cat."' LIMIT 1");
		if(!$execute) { return false; }

		return true;

	}

	public static function deleteCatPermanent($cat) {

		$packsList = '';
		$consultaPacks = DB::Executa("SELECT * FROM site_shop_packs WHERE scat_id = '".$cat."'");
		if(count($consultaPacks) > 0) {
			for($i=0, $c=count($consultaPacks); $i < $c; $i++) {
				$packsList .= $consultaPacks[$i]['spack_id'].",";
			}
			$packsList = substr($packsList, 0, -1);
		}

		if(!empty($packsList)) {
			if(!DB::Executa("DELETE FROM site_shop_itens WHERE spack_id IN (".$packsList.")")) {
				return false;
			}
		}

		if(!DB::Executa("DELETE FROM site_shop_packs WHERE scat_id = '".$cat."'")) {
			return false;
		}

		if(!DB::Executa("DELETE FROM site_shop_categories WHERE scat_id = '".$cat."' LIMIT 1")) {
			return false;
		}

		return true;

	}

	public static function updateCat($cat, $nome) {
		$sql = "UPDATE site_shop_categories SET nome = '".$nome."' WHERE scat_id = '".$cat."' LIMIT 1";
		return DB::Executa($sql);
	}

	public static function insertPack($nome, $imagem, $ordem, $data, $cat, $valor) {
		$sql = "INSERT INTO site_shop_packs (nome, imagem, ordem, data_c, scat_id, valor) VALUES ('".$nome."','".$imagem."', '".$ordem."', '".$data."', '".$cat."', '".$valor."')";
		return DB::Executa($sql);
	}

	public static function checkPackNameExists($nome, $pack=0) {
		$sql = "SELECT * FROM site_shop_packs WHERE nome = '".$nome."' AND spack_id <> '".$pack."' LIMIT 1";
		return DB::Executa($sql);
	}

	public static function findLastPack() {
		$sql = "SELECT ordem FROM site_shop_packs ORDER BY ordem DESC LIMIT 1";
		return DB::Executa($sql);
	}

	public static function listPacks($cat='', $viewItens=0) {
		$sql = "SELECT P.*, C.nome AS cat".($viewItens == 1 ? ", (SELECT COUNT(*) FROM site_shop_itens AS I WHERE I.spack_id = P.spack_id) AS itens" : "")." FROM site_shop_packs AS P LEFT JOIN site_shop_categories AS C ON C.scat_id = P.scat_id ".(!empty($cat) ? "WHERE P.scat_id = '".$cat."'" : "")." ORDER BY P.ordem ASC";
		return DB::Executa($sql);
	}

	public static function findPack($pack) {
		$sql = "SELECT * FROM site_shop_packs WHERE spack_id = '".$pack."' LIMIT 1";
		return DB::Executa($sql);
	}

	public static function findItem($item) {
		$sql = "SELECT * FROM site_shop_itens WHERE sitem_id = '".$item."' LIMIT 1";
		return DB::Executa($sql);
	}

	public static function deleteItem($item) {
		$sql = "DELETE FROM site_shop_itens WHERE sitem_id = '".$item."' LIMIT 1";
		return DB::Executa($sql);
	}

	public static function updatePack($pack, $nome, $cat, $imagem, $data, $valor) {
		if(!empty($imagem)) {
			$queryImg = "imagem = '".$imagem."',";
		} else {
			$queryImg = "";
		}
		$sql = "UPDATE site_shop_packs SET nome = '".$nome."', scat_id = '".$cat."', ".$queryImg." data_a = '".$data."', valor = '".$valor."' WHERE spack_id = '".$pack."' LIMIT 1";
		return DB::Executa($sql);
	}

	public static function deletePack($pack, $newPack) {

		$execute = DB::Executa("UPDATE site_shop_itens SET spack_id = '".$newPack."' WHERE spack_id = '".$pack."'");
		if(!$execute) { return false; }

		$execute = DB::Executa("DELETE FROM site_shop_packs WHERE spack_id = '".$pack."' LIMIT 1");
		if(!$execute) { return false; }

		return true;

	}

	public static function deletePackPermanent($pack) {

		if(!DB::Executa("DELETE FROM site_shop_itens WHERE spack_id = '".$pack."'")) {
			return false;
		}

		if(!DB::Executa("DELETE FROM site_shop_packs WHERE spack_id = '".$pack."' LIMIT 1")) {
			return false;
		}

		return true;

	}

	public static function listItens($pack) {
		$sql = "SELECT * FROM site_shop_itens WHERE spack_id = '".$pack."' ORDER BY ordem ASC";
		return DB::Executa($sql);
	}

	public static function insertItem($id_ingame, $pack, $nome, $amount, $cumulativo, $sa, $enchant, $valor, $ordem, $data) {
		$sql = "INSERT INTO site_shop_itens (id_ingame, amount, cumulativo, spack_id, nome, sa, enchant, valor, ordem, data_c) VALUES ('".$id_ingame."','".$amount."','".$cumulativo."','".$pack."', '".$nome."', '".$sa."', '".$enchant."', '".$valor."', '".$ordem."', '".$data."')";
		return DB::Executa($sql);
	}

	public static function findLastItem() {
		$sql = "SELECT ordem FROM site_shop_itens ORDER BY ordem DESC LIMIT 1";
		return DB::Executa($sql);
	}

	public static function catReorder($pos, $itemID) {
		$sql = "UPDATE site_shop_categories SET ordem = '".$pos."' WHERE scat_id = '".$itemID."' LIMIT 1";
		return DB::Executa($sql);
	}

	public static function itemReorder($pos, $itemID) {
		$sql = "UPDATE site_shop_itens SET ordem = '".$pos."' WHERE sitem_id = '".$itemID."' LIMIT 1";
		return DB::Executa($sql);
	}

	public static function packReorder($pos, $itemID) {
		$sql = "UPDATE site_shop_packs SET ordem = '".$pos."' WHERE spack_id = '".$itemID."' LIMIT 1";
		return DB::Executa($sql);
	}

}
