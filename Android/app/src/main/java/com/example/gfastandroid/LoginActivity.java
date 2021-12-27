package com.example.gfastandroid;


import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.FragmentManager;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.example.gfastandroid.listeners.UserListener;
import com.example.gfastandroid.modelo.SingletonGestorGfast;
import com.example.gfastandroid.utils.GFastJsonParser;

public class LoginActivity extends AppCompatActivity implements UserListener {

    private EditText etUserName, etPassword;
    private Button btnLogin;
    private TextView btnToRegister;
    private FragmentManager fragmentManager;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        etUserName = findViewById(R.id.etUserName);
        etPassword = findViewById(R.id.etPassword);
        btnLogin = findViewById(R.id.btnLogin);
        btnToRegister = findViewById(R.id.btnToRegister);


        btnToRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(LoginActivity.this, RegisterActivity.class);
                startActivity(i);


            }
        });

    }

    public void onClickLogin(View view) {
        String username = etUserName.getText().toString();
        String password = etPassword.getText().toString();


        SingletonGestorGfast.getInstance(getApplicationContext()).setUserListener(this);

        if (!isEmailValido(username)) {
            etUserName.setError(getString(R.string.login_etEmail_Erro));
            return;
        }

        if (!isPasswordValida(password)) {
            etPassword.setError(getString(R.string.login_etPassword_Erro));
            return;
        }


        if (GFastJsonParser.isConnectionInternet(getApplicationContext())) {

            SingletonGestorGfast.getInstance(getApplicationContext()).loginUserAPI(username, password, getApplicationContext());

        } else {
            Toast.makeText(getApplicationContext(), "Não tem ligação à rede", Toast.LENGTH_SHORT).show();
        }


    }


    private boolean isEmailValido(String email) {
        if (email == null)
            return false;
        return email.length() >= 4;
    }

    private boolean isPasswordValida(String password) {
        if (password == null)
            return false;
        return password.length() >= 4;
    }


    public void onValidateLogin(String token, String username) {
        if (token != null) {

            guardarInfoSharedPref(token, username);


            Intent intent = new Intent(getApplicationContext(), MenuMainActivity.class);
            intent.putExtra(MenuMainActivity.USERNAME, username);
            startActivity(intent);
            finish();



            Toast.makeText(getApplicationContext(), "Bem Vindo!", Toast.LENGTH_LONG).show();
        } else {

            etPassword.setError("Utilizador ou Palavra-Passe Incorretos!");
        }
    }

    @Override
    public void onErroLogin() {

        etPassword.setError("Utilizador ou Palavra-Passe Incorretos!");
    }

    private void guardarInfoSharedPref(String token, String username) {

        /*SharedPreferences sharedPreferencesUser = getActivity().getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferencesUser.edit();

        editor.putString(MenuMainActivity.USERNAME, username);
        editor.putString(MenuMainActivity.TOKEN, token);

        editor.apply();*/


    }
}