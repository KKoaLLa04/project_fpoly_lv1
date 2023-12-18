<?php
function get_list_categories()
{
   $result = db_fetch_array("SELECT c.name, c.description, c.created_at FROM `categories` c");
   return $result;
}
function create_category($name, $description)
{
   $id = db_insert('categories', [
      'name' => $name,
      'description' => $description,
      'created_at' => date('Y-m-d H:i:s')
   ]);
   return $id;
};
function  delete_category($id)
{
   db_delete('categories', "id=$id");
   return true;
};
function get_one_category($id)
{
   $result = db_fetch_row(" SElECT * FROM `categories` WHERE id_cat={$id}");
   print_r($result);
   return $result;
}
function update_category($id, $name, $description)
{
   db_update('categories', [
      'name' => $name,
      'description' => $description,
   ], "id_cat=$id");
   return true;
};
