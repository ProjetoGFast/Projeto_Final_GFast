package com.example.gfastandroid.modelo;

public class User {


    private int id;
    private String username, auth_key, password_reset_token, email, verification_token, us_nome, us_apelido, us_cidade;
    private int  us_telemovel, us_contribuinte, us_pontos;

    public User(int id, String username, String auth_key, String password_reset_token, String email, String verification_token, String us_nome, String us_apelido, String us_cidade, int us_telemovel, int us_contribuinte, int us_pontos) {
        this.id = id;

        this.username = username;
        this.auth_key = auth_key;
        this.password_reset_token = password_reset_token;
        this.email = email;
        this.verification_token = verification_token;
        this.us_nome = us_nome;
        this.us_apelido = us_apelido;
        this.us_cidade = us_cidade;
        this.us_telemovel = us_telemovel;
        this.us_contribuinte = us_contribuinte;
        this.us_pontos = us_pontos;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }




    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getAuth_key() {
        return auth_key;
    }

    public void setAuth_key(String auth_key) {
        this.auth_key = auth_key;
    }

    public String getPassword_reset_token() {
        return password_reset_token;
    }

    public void setPassword_reset_token(String password_reset_token) {
        this.password_reset_token = password_reset_token;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getVerification_token() {
        return verification_token;
    }

    public void setVerification_token(String verification_token) {
        this.verification_token = verification_token;
    }

    public String getUs_nome() {
        return us_nome;
    }

    public void setUs_nome(String us_nome) {
        this.us_nome = us_nome;
    }

    public String getUs_apelido() {
        return us_apelido;
    }

    public void setUs_apelido(String us_apelido) {
        this.us_apelido = us_apelido;
    }

    public String getUs_cidade() {
        return us_cidade;
    }

    public void setUs_cidade(String us_cidade) {
        this.us_cidade = us_cidade;
    }

    public int getUs_telemovel() {
        return us_telemovel;
    }

    public void setUs_telemovel(int us_telemovel) {
        this.us_telemovel = us_telemovel;
    }

    public int getUs_contribuinte() {
        return us_contribuinte;
    }

    public void setUs_contribuinte(int us_contribuinte) {
        this.us_contribuinte = us_contribuinte;
    }

    public int getUs_pontos() {
        return us_pontos;
    }

    public void setUs_pontos(int us_pontos) {
        this.us_pontos = us_pontos;
    }

}
