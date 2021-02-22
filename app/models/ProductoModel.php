<?php
class ProductoModel{
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function getProductos($idproducto = null, $order = null, $limit = null, $masvendidos = null){
        if($idproducto == null){
            $cond = '';
            if( $order != null )
                $cond .= " ORDER BY p.idproducto $order";
            if( $masvendidos != null )
                $cond .= " ORDER BY p.vendidos $masvendidos";
            if( $limit != null )
                $cond .= " LIMIT  $limit";

            $this->db->query("select p.idproducto, p.nombre, p.descripcion, p.imagen, p.imagen_small, p.precio_venta, p.precio_compra, p.stock, p.idcategoria, p.codigo, c.categoria, p.vendidos from producto p inner join categoria c on p.idcategoria=c.idcategoria $cond");
            return $this->db->rows();
        }else{            
            $this->db->query("select p.idproducto, p.nombre, p.descripcion, p.imagen, p.imagen_small, p.precio_venta, p.precio_compra, p.stock, p.idcategoria, p.codigo, c.categoria, p.vendidos from producto p inner join categoria c on p.idcategoria=c.idcategoria where p.idproducto=:idproducto");
            $this->db->bind(":idproducto", $idproducto);
            return $this->db->row();
        }        
    }

    public function lastIdProducto(){
        $query = "select max(idproducto) as id from producto";
        $this->db->query($query);
        return $this->db->row();
    }

    public function existsIdProducto($idproducto){
        $query = "select idproducto from producto where idproducto=:idproducto";
        $this->db->query($query);
        $this->db->bind(":idproducto", $idproducto);
        return $this->db->row();
    }

    public function insertProducto($data){
        $query = "insert into producto(nombre, descripcion, precio_venta, precio_compra, stock, idcategoria, vendidos) values(:nombre, :descripcion, :precio_venta, :precio_compra, :stock, :idcategoria, :vendidos)";

        $this->db->query($query);
        $this->db->bind(":nombre", $data['nombre']);
        $this->db->bind(":descripcion", $data['descripcion']);
        $this->db->bind(":precio_venta", $data['preciov']);
        $this->db->bind(":precio_compra", $data['precioc']);
        $this->db->bind(":stock", $data['stock']);
        $this->db->bind(":idcategoria", $data['idcategoria']);
        $this->db->bind(":vendidos", $data['vendidos']);
        
        if($this->db->execute())
            return $this->db->lastId();
    }

    public function updateImageCodigo($codigo,$ruta, $ruta_small, $idproducto){
        $query = "update producto set imagen=:imagen, imagen_small=:imagen_small, codigo=:codigo where idproducto=:idproducto";

        $this->db->query($query);
        $this->db->bind(":imagen", $ruta);
        $this->db->bind(":imagen_small", $ruta_small);
        $this->db->bind(":codigo", $codigo);
        $this->db->bind(":idproducto", $idproducto);

        return $this->db->execute();
    }

    public function updateProducto($data){
        $query = "update producto set nombre=:nombre, descripcion=:descripcion, imagen=:imagen, imagen_small=:imagen_small, precio_venta=:precio_venta, precio_compra=:precio_compra, stock=:stock, idcategoria=:idcategoria, vendidos=:vendidos where idproducto=:idproducto";

        $this->db->query($query);
        $this->db->bind(":nombre", $data['nombre']);
        $this->db->bind(":descripcion", $data['descripcion']);
        $this->db->bind(":imagen", $data['ruta']);
        $this->db->bind(":imagen_small", $data['ruta_small']);
        $this->db->bind(":precio_venta", $data['preciovp']);
        $this->db->bind(":precio_compra", $data['preciocp']);
        $this->db->bind(":stock", $data['stock']);
        $this->db->bind(":idcategoria", $data['idcategoria']);
        $this->db->bind(":vendidos", $data['vendidos']);
        $this->db->bind(":idproducto", $data['idproducto']);

        return $this->db->execute();
    }

    public function deleteProducto($idproducto){
        $query = "delete from producto where idproducto=:idproducto";
        $this->db->query($query);
        $this->db->bind(":idproducto", $idproducto);
        return $this->db->execute();
    }

    public function resultadoBusqueda($vars_from_url, $idcategoria, $limit = '2'){
        $cond = "";
        if($idcategoria != ''){
            $cond .= " and p.idcategoria=:idcategoria";
        }
        if(isset($vars_from_url['buscar'])){
            $cond .= " and (p.nombre LIKE '%' :buscar '%' or p.descripcion LIKE '%' :buscar '%' or c.categoria LIKE '%' :buscar '%' or p.codigo LIKE '%' :buscar '%')";
        }
        if(isset($vars_from_url['nombre']) && !isset($vars_from_url['precio'])){
            $cond .= " order by p.nombre ".$vars_from_url['nombre']."";
        }
        if(!isset($vars_from_url['nombre']) && isset($vars_from_url['precio'])){
            $cond .= " order by p.precio_venta ".$vars_from_url['precio']."";
        }
        if(isset($vars_from_url['nombre']) && isset($vars_from_url['precio'])){
            $cond .= " order by p.nombre ".$vars_from_url['nombre'].", p.precio_venta ".$vars_from_url['precio']."";
        }
        //print_r($vars_from_url);
        $query = "select p.idproducto, p.codigo, p.nombre, p.imagen_small, p.descripcion, p.precio_venta, p.idcategoria, c.categoria
        from producto p 
        inner join categoria c on p.idcategoria=c.idcategoria 
        where p.idproducto is not null $cond limit $limit";
        $this->db->query($query);
        if($idcategoria != '') 
            $this->db->bind(":idcategoria", $idcategoria);
        if(isset($vars_from_url['buscar'])) 
            $this->db->bind(":buscar", $vars_from_url['buscar']);
        return $this->db->rows();
    }

    public function countResultadoBusqueda($vars_from_url, $idcategoria){
        $cond = "";
        if($idcategoria != ''){
            $cond .= " and p.idcategoria=:idcategoria";
        }
        if(isset($vars_from_url['buscar'])){
            $cond .= " and (p.nombre LIKE '%' :buscar '%' or p.descripcion LIKE '%' :buscar '%' or c.categoria LIKE '%' :buscar '%' or p.codigo LIKE '%' :buscar '%')";
        }
        if(isset($vars_from_url['nombre']) && !isset($vars_from_url['precio'])){
            $cond .= " order by p.nombre ".$vars_from_url['nombre']."";
        }
        if(!isset($vars_from_url['nombre']) && isset($vars_from_url['precio'])){
            $cond .= " order by p.precio_venta ".$vars_from_url['precio']."";
        }
        if(isset($vars_from_url['nombre']) && isset($vars_from_url['precio'])){
            $cond .= " order by p.nombre ".$vars_from_url['nombre'].", p.precio_venta ".$vars_from_url['precio']."";
        }

        $query = "select count(*) as TOTAL
        from producto p 
        inner join categoria c on p.idcategoria=c.idcategoria 
        where p.idproducto is not null $cond";
        $this->db->query($query);
        if($idcategoria != '') 
            $this->db->bind(":idcategoria", $idcategoria);
        if(isset($vars_from_url['buscar'])) 
            $this->db->bind(":buscar", $vars_from_url['buscar']);
        return $this->db->row();
    }

}