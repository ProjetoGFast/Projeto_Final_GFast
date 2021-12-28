package com.example.gfastandroid;


import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.FragmentManager;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
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
    private Button btnToRegister;
    private FragmentManager fragmentManager;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getSupportActionBar().hide();
        setContentView(R.layout.activity_login);

        etUserName = findViewById(R.id.etUserName);
        etPassword = findViewById(R.id.etPassword);
        btnLogin = findViewById(R.id.btnLogin);
        btnToRegister = findViewById(R.id.btnToRegister);


        btnToRegister = (Button) findViewById(R.id.btnToRegister);
        btnToRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onClickToRegister();
            }
        });

    }

    public void onClickToRegister(){
        Intent intent = new Intent(this, RegisterActivity.class);
        startActivity(intent);
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

            loginSharedPreferences(token, username);


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

    private void loginSharedPreferences(String token, String username) {

        SharedPreferences sharedPreferences = getSharedPreferences("Login", 0);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putString("username", username );
        editor.putString("token", token );
        editor.commit();

    }
}