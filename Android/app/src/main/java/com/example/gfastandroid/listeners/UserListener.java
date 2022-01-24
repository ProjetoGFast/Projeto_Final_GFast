package com.example.gfastandroid.listeners;

import com.example.gfastandroid.modelo.User;
public interface UserListener {


    void onValidateLogin(User user);

    void onErroLogin();

    void loginSharedPreferences(User user);

    void onErroEditar(String mensagem);
}
