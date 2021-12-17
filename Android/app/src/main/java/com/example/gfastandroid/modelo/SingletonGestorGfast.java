package com.example.gfastandroid.modelo;

//import com.android.volley.RequestQueue;


import android.content.Context;
import android.widget.Toast;

import com.example.gfastandroid.R;

import java.util.ArrayList;

public class SingletonGestorGfast {

    private ArrayList<Guitarra> guitarras;
    private static SingletonGestorGfast instance = null;


    public static synchronized SingletonGestorGfast getInstance(){
        if(instance == null)
            instance = new SingletonGestorGfast();

        return instance;
    }
    public SingletonGestorGfast() {
        gerarDadosDinamicos();
    }

    private void gerarDadosDinamicos(){

        guitarras = new ArrayList<>();

        Guitarra guitarra = new Guitarra(1,2, 2,23, 34, "Fender", "G001", "GuitarraGfast");

        guitarras.add(guitarra);

    }
    public ArrayList<Guitarra> getGuitarras()
    {

        return new ArrayList<>(guitarras);
    }
}
