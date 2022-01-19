package com.example.gfastandroid.modelo;

public class Favoritos {


    private int fav_id, fav_idguitarras, fav_iduser;

    public Favoritos(int fav_id, int fav_idguitarras, int fav_iduser) {
        this.fav_id = fav_id;
        this.fav_idguitarras = fav_idguitarras;
        this.fav_iduser = fav_iduser;
    }

    public int getFav_id() {
        return fav_id;
    }

    public void setFav_id(int fav_id) {
        this.fav_id = fav_id;
    }

    public int getFav_idguitarras() {
        return fav_idguitarras;
    }

    public void setFav_idguitarras(int fav_idguitarras) {
        this.fav_idguitarras = fav_idguitarras;
    }

    public int getFav_iduser() {
        return fav_iduser;
    }

    public void setFav_iduser(int fav_iduser) {
        this.fav_iduser = fav_iduser;
    }
}
