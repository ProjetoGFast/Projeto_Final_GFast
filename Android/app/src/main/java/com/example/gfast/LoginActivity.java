package com.example.gfast;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class LoginActivity extends AppCompatActivity {

    public EditText Etmail;
    public EditText Etpassword;
    public Button btnLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        
        Etmail= findViewById(R.id.etemail);
        Etpassword=findViewById(R.id.etpassword);
        btnLogin = findViewById(R.id.btnLogin);
    }

    public void onClickLogin(View view) {
        String email = Etmail.getText().toString();
        String password = Etpassword.getText().toString();
        if (!isEmailValido(email)){
            Etmail.setError("Email Inválido");
            return;
        }

        if (!isPasswordValida(password)){
            Etpassword.setError("Password Inválida");
            return;
        }

        //Código para abrir nova atividade

        Intent intent = new Intent(getApplicationContext(), MainActivity.class);
       // intent.putExtra(MainActivity.EMAIL, email);
        startActivity(intent);
        finish();
    }




    private boolean isEmailValido(String Email)
    {


        if(Email == null)
            return false;

        return Patterns.EMAIL_ADDRESS.matcher(Email).matches();



    }
    private boolean isPasswordValida(String password)
    {
        if(password == null)
            return false;


        return password.length() >= 4;
    }
}