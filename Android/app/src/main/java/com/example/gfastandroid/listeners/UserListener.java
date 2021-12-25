package com.example.gfastandroid.listeners;

//import com.example.gfastandroid.modelo.User;
public interface UserListener {

   // void onUserRegistado(String response);

    void onValidateLogin(String token, String username);

  //  void onRefreshDetalhes(String response);

   // void onApagarConta();

    void onErroLogin();

   // void onLoadEditarRegisto(Utilizador utilizador);
}
