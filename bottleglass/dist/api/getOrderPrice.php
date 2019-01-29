<?php

function getOrderPrice($id) {
  require_once './bdd.php';
  $sql = "SELECT SUM(tb_panier.quantite_pan * tb_produits.prix_pro + tb_commandes.shipping_com * 6) FROM `tb_panier` INNER JOIN tb_produits ON tb_produits.id_pro = tb_panier.id_fk_produit INNER JOIN tb_commandes ON tb_commandes.id_com = tb_panier.id_fk_commande WHERE `id_fk_commande` = :id GROUP BY tb_panier.id_fk_commande;";
  $stmt = $db->prepare($sql);
  $stmt->execute(array(':id' => $id));
  return $stmt->fetchAll()[0][0];
}

