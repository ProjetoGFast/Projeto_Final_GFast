package com.example.gfastandroid.listeners;

import com.example.gfastandroid.modelo.User;
public interface UserListener {

    void onUserRegistado(String response);

    void onValidateLogin(User user);

     void onRefreshDetalhes(String response);

    void onApagarConta();

    void onErroLogin();

    void onLoadEditarRegisto(User utilizador);

    void onErroEditar(String mensagem);
}
