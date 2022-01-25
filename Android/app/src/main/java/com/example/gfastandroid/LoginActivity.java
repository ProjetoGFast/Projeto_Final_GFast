package com.example.gfastandroid;


import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.FragmentManager;

import android.content.Context;
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
import com.example.gfastandroid.modelo.User;
import com.example.gfastandroid.utils.GFastJsonParser;

public class LoginActivity extends AppCompatActivity implements UserListener {

    private EditText etUserName, etPassword;
    private Button btnLogin;
    private Button btnToRegister;
    private FragmentManager fragmentManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        try {
            //Meter Listener à escuta
            SingletonGestorGfast.getInstance(getApplicationContext()).setUserListener(this);

            requestWindowFeature(Window.FEATURE_NO_TITLE);
            getSupportActionBar().hide();

            //Definir a Vista do Login
            setContentView(R.layout.activity_login);

            etUserName = findViewById(R.id.etUserName);
            etPassword = findViewById(R.id.etPassword);
            btnLogin = findViewById(R.id.btnLogin);
            btnToRegister = findViewById(R.id.btnToRegister);


            //Obter Username e Verification token das SharedPreferences
            SharedPreferences sharedPreferencesUser = getSharedPreferences(MenuMainActivity.LOGIN, Context.MODE_PRIVATE);
            String username = sharedPreferencesUser.getString(MenuMainActivity.USERNAME, null);
            String token = sharedPreferencesUser.getString(MenuMainActivity.TOKEN, null);

            if (username != null && token != null) {

                //Compara os dados na sharedpreferences aos que estão na bd
                if (SingletonGestorGfast.getInstance(getApplicationContext()).getLoggedUser(username, token)) {
                    //Abrir a atividade MenuMainActivity caso já exista um user logado
                    Intent intent = new Intent(getApplicationContext(), MenuMainActivity.class);
                    startActivity(intent);
                    finish();
                }

            }


            btnToRegister = (Button) findViewById(R.id.btnToRegister);
            btnToRegister.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    onClickToRegister();
                }
            });
        } catch (Exception e) {
            e.printStackTrace();
        }

    }

    public void onClickToRegister() {
        //Abrir atividade de Registo
        Intent intent = new Intent(this, RegisterActivity.class);
        startActivity(intent);
    }


    public void onClickLogin(View view) {
        try {

            String username = etUserName.getText().toString();
            String password = etPassword.getText().toString();


            if (!isEmailValido(username)) {
                etUserName.setError(getString(R.string.login_etEmail_Erro));
                return;
            }

            if (!isPasswordValida(password)) {
                etPassword.setError(getString(R.string.login_etPassword_Erro));
                return;
            }

            // Fazer Login na Aplicação
            if (GFastJsonParser.isConnectionInternet(getApplicationContext())) {
                SingletonGestorGfast.getInstance(getApplicationContext()).loginUserAPI(username, password, getApplicationContext());


            } else {
                Toast.makeText(getApplicationContext(), "Não tem ligação à rede", Toast.LENGTH_SHORT).show();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

    }


    private boolean isEmailValido(String email) {
        //Verificar se o email é válido
        if (email == null)
            return false;
        return email.length() >= 4;
    }

    private boolean isPasswordValida(String password) {
        //Verificar se a Password é válida
        if (password == null)
            return false;
        return password.length() >= 4;
    }


    @Override
    public void onValidateLogin(User user) {
        try {
            //validar login
            if (user.getId() != 0) {

                loginSharedPreferences(user);

                Toast.makeText(getApplicationContext(), "Bem Vindo!", Toast.LENGTH_LONG).show();
            } else {

                etPassword.setError("Utilizador ou Palavra-Passe Incorretos!");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }


    @Override
    public void onErroLogin() {

        etPassword.setError("Utilizador ou Palavra-Passe Incorretos!");
    }

    @Override
    public void onErroEditar(String mensagem) {
        setContentView(R.layout.fragment_perfil);
        String username = etUserName.getText().toString();

        etUserName.setError("UsernameInvalido");
    }

    @Override
    public void loginSharedPreferences(User user) {
        try {
            //Guardar Username , iduser e verification token nas sharedpreferences
            SharedPreferences sharedPreferences = getSharedPreferences("Login", 0);
            SharedPreferences.Editor editor = sharedPreferences.edit();
            editor.putInt("iduser", user.getId());
            editor.putString("username", user.getUsername());
            editor.putString("token", user.getVerification_token());

            editor.commit();
            //Abrir a ativiade MenuMain Activity
            Intent intent = new Intent(getApplicationContext(), MenuMainActivity.class);
            intent.putExtra(MenuMainActivity.USERNAME, user.getUsername());
            startActivity(intent);
            finish();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}