package com.example.gfastandroid;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.gfastandroid.modelo.SingletonGestorGfast;
import com.example.gfastandroid.utils.GFastJsonParser;

public class RegisterActivity extends AppCompatActivity {

    private EditText etUserName, etEmail, etName, etSurname, etCity, etPhone, etContribuinte, etPassword;
    private Button btnRegister;
    private Button btnToLogin;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getSupportActionBar().hide();
        setContentView(R.layout.activity_register);

        etUserName = findViewById(R.id.etUserName);
        etEmail = findViewById(R.id.etEmail);
        etName = findViewById(R.id.etName);
        etSurname = findViewById(R.id.etSurname);
        etCity = findViewById(R.id.etCity);
        etPhone = findViewById(R.id.etPhone);
        etContribuinte = findViewById(R.id.etContribuinte);
        etPassword = findViewById(R.id.etPassword);
        btnToLogin = findViewById(R.id.btnToLogin);
        btnRegister = findViewById(R.id.btnLogin);


        btnToLogin = (Button) findViewById(R.id.btnToLogin);
        btnToLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onClickToLogin();
            }
        });
    }

    public void onClickToLogin() {
        Intent intent = new Intent(this, LoginActivity.class);
        startActivity(intent);

    }

    public void onClickRegister(View view) {
        try {
            String username = etUserName.getText().toString();
            String email = etEmail.getText().toString();
            String nome = etName.getText().toString();
            String apelido = etSurname.getText().toString();
            String cidade = etCity.getText().toString();
            String telemovel = etPhone.getText().toString();
            String contribuinte = etContribuinte.getText().toString();
            String password = etPassword.getText().toString();


            if (!isUserNameValido(username)) {
                etUserName.setError(getString(R.string.login_etUserName_Erro));
                return;
            }

            if (!isEmailValido(email)) {
                etEmail.setError(getString(R.string.login_etEmail_Erro));
                return;
            }

            if (!isNameValido(nome)) {
                etName.setError(getString(R.string.login_etName_Erro));
                return;
            }

            if (!isSurnameValido(apelido)) {
                etSurname.setError(getString(R.string.login_etSurname_Erro));
                return;
            }

            if (!isCityValido(cidade)) {
                etCity.setError(getString(R.string.login_etCity_Erro));
                return;
            }

            if (!isPhoneValido(telemovel)) {
                etPhone.setError(getString(R.string.login_etPhone_Erro));
                return;
            }

            if (!isContribuinteValido(contribuinte)) {
                etContribuinte.setError(getString(R.string.login_etContribuinte_Erro));
                return;
            }

            if (!isPasswordValida(password)) {
                etPassword.setError(getString(R.string.login_etPassword_Erro));
                return;
            }

            if (GFastJsonParser.isConnectionInternet(getApplicationContext())) {
                //Registar Utilizador
                SingletonGestorGfast.getInstance(getApplicationContext()).registarUser(username, password, email, nome, apelido, cidade, telemovel, contribuinte, getApplicationContext());

            } else {
                Toast.makeText(getApplicationContext(), "Não tem ligação à rede", Toast.LENGTH_SHORT).show();
            }
            //Abrir a ativiadade MenuMainActivity
            Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
            intent.putExtra(MenuMainActivity.USERNAME, email);
            startActivity(intent);
            finish();
        } catch (Exception e) {
            e.printStackTrace();
        }

    }

    private boolean isUserNameValido(String username) {
        if (username == null)
            return false;
        return true;
    }

    private boolean isEmailValido(String email) {
        if (email == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    private boolean isNameValido(String name) {
        return name != null;
    }

    private boolean isSurnameValido(String surname) {
        return surname != null;
    }

    private boolean isCityValido(String city) {
        return city != null;
    }

    private boolean isPhoneValido(String phone) {
        return phone != null;
    }

    private boolean isContribuinteValido(String contribuinte) {
        return contribuinte != null;
    }

    private boolean isPasswordValida(String password) {
        if (password == null)
            return false;
        return password.length() >= 4;
    }

}
