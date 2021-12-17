package com.example.gfastandroid.modelo;

public class Marca {




    private int mar_id,mar_inativo;
    private String mar_nome;

    public Marca(int mar_id, int mar_inativo, String mar_nome) {
        this.mar_id = mar_id;
        this.mar_inativo = mar_inativo;
        this.mar_nome = mar_nome;
    }

    public int getMar_id() {
        return mar_id;
    }

    public void setMar_id(int mar_id) {
        this.mar_id = mar_id;
    }

    public int getMar_inativo() {
        return mar_inativo;
    }

    public void setMar_inativo(int mar_inativo) {
        this.mar_inativo = mar_inativo;
    }

    public String getMar_nome() {
        return mar_nome;
    }

    public void setMar_nome(String mar_nome) {
        this.mar_nome = mar_nome;
    }
}
