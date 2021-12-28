package com.example.gfastandroid.vistas;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

import com.example.gfastandroid.R;

public class DetalhesGuitarrasActivity extends AppCompatActivity {
    public static final String ID_GUITARRA = "IDLIVRO";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_guitarras);
    }
}