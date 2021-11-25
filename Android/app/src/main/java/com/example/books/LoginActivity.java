package com.example.books;


import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import com.example.books.vistas.MainActivity;

public class LoginActivity extends AppCompatActivity {

    private EditText etEmail, etPassword;
    private Button btnLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        etEmail = findViewById(R.id.etEmail);
        etPassword = findViewById(R.id.etPassword);
        btnLogin = findViewById(R.id.btnLogin);
    }

    public void onClickLogin(View view) {
        String email = etEmail.getText().toString();
        String password = etPassword.getText().toString();


        if (!isEmailValido(email)){
            etEmail.setError(getString(R.string.login_etEmail_Erro));
            return;
        }

        if (!isPasswordValida(password)){
            etPassword.setError(getString(R.string.login_etPassword_Erro));
            return;
        }

        Intent intent = new Intent(getApplicationContext(), MenuMainActivity.class);
        intent.putExtra(MenuMainActivity.EMAIL, email);
        startActivity(intent);
        finish();

    }


    private boolean isEmailValido(String email){
        if (email == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }
    private boolean isPasswordValida(String password){
        if (password == null)
            return false;
        return password.length() >= 4;
    }
}