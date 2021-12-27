package com.example.gfastandroid.vistas;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.example.gfastandroid.R;

public class MainActivity extends AppCompatActivity {

    public static final String EMAIL = "email";
    private TextView tvEmail;
    private String email;


    public void onClickDetalhesEmail(View view) {
        String subject = "AMSI 2021/2022";
        String message = "olá " + email + " isto é uma mensagem de texto enviada pela minha APP! :)";

        Intent intent = new Intent(Intent.ACTION_SEND);
        intent.setType("message/rfc822");
        intent.putExtra(Intent.EXTRA_EMAIL, new String[]{email});
        intent.putExtra(Intent.EXTRA_SUBJECT, subject);
        intent.putExtra(Intent.EXTRA_TEXT, message);

        if (intent.resolveActivity(getPackageManager()) != null){
            startActivity(intent);
        }
    }

    @Override
    protected void onStart(){
        super.onStart();
        System.out.println("--> onStrart()");
    }

    protected void onResume(){
        super.onResume();
        System.out.println("--> onResume()");
    }

    protected void onPause(){
        super.onPause();
        System.out.println("--> onPause()");
    }

    protected void onStop(){
        super.onStop();
        System.out.println("--> onStop()");
    }

    protected void onDestroy(){
        super.onDestroy();
        System.out.println("--> onDestroy()");
    }
}