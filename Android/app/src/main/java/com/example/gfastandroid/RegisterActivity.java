package com.example.gfastandroid;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;

import androidx.appcompat.app.AppCompatActivity;

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

    public void onClickToLogin(){
        Intent intent = new Intent(this, LoginActivity.class);
        startActivity(intent);

    }

    public void onClickRegister(View view) {

        String username = etUserName.getText().toString();
        String email = etEmail.getText().toString();
        String name = etName.getText().toString();
        String surname = etSurname.getText().toString();
        String city = etCity.getText().toString();
        String phone = etPhone.getText().toString();
        String contribuinte = etContribuinte.getText().toString();
        String password = etPassword.getText().toString();


        if (!isUserNameValido(username)){
            etEmail.setError(getString(R.string.login_etUserName_Erro));
            return;
        }

        if (!isEmailValido(email)){
            etEmail.setError(getString(R.string.login_etEmail_Erro));
            return;
        }

        if (!isNameValido(name)){
            etName.setError(getString(R.string.login_etName_Erro));
            return;
        }

        if (!isSurnameValido(surname)){
            etSurname.setError(getString(R.string.login_etSurname_Erro));
            return;
        }

        if (!isCityValido(city)){
            etCity.setError(getString(R.string.login_etCity_Erro));
            return;
        }

        if (!isPhoneValido(phone)){
            etPhone.setError(getString(R.string.login_etPhone_Erro));
            return;
        }

        if (!isContribuinteValido(contribuinte)){
            etContribuinte.setError(getString(R.string.login_etContribuinte_Erro));
            return;
        }

        if (!isPasswordValida(password)){
            etPassword.setError(getString(R.string.login_etPassword_Erro));
            return;
        }

        Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
        intent.putExtra(MenuMainActivity.EMAIL, email);
        startActivity(intent);
        finish();

    }
    private boolean isUserNameValido(String username){
        if (username == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(username).matches();
    }
    private boolean isEmailValido(String email){
        if (email == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }
    private boolean isNameValido(String name){
        if (name == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(name).matches();
    }
    private boolean isSurnameValido(String surname){
        if (surname == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(surname).matches();
    }
    private boolean isCityValido(String city){
        if (city == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(city).matches();
    }
    private boolean isPhoneValido(String phone){
        if (phone == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(phone).matches();
    }
    private boolean isContribuinteValido(String contribuinte){
        if (contribuinte == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(contribuinte).matches();
    }
    private boolean isPasswordValida(String password){
        if (password == null)
            return false;
        return password.length() >= 4;
    }

}
