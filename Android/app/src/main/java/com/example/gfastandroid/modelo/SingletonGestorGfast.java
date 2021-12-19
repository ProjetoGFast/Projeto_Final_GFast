package com.example.gfastandroid.modelo;

//import com.android.volley.RequestQueue;


import android.content.Context;
import android.widget.Toast;

import com.example.gfastandroid.R;

import java.util.ArrayList;

public class SingletonGestorGfast {

    private ArrayList<Guitarra> guitarras;
    private static SingletonGestorGfast instance = null;


    public static synchronized SingletonGestorGfast getInstance() {
        if (instance == null)
            instance = new SingletonGestorGfast();

        return instance;
    }

    public SingletonGestorGfast() {
        gerarDadosDinamicos();
    }

    private void gerarDadosDinamicos() {

        guitarras = new ArrayList<>();

        Guitarra guitarra = new Guitarra(1, 1, 1, 1, 1, "eh", "he", "hdsa", "wer", "eds", 0);
        guitarras.add(new Guitarra(1, 1, 1, 1, 1, "eh", "he", "hdsa", "wer", "eds", 0));
        guitarras.add(new Guitarra(1, 1, 1, 1, 1, "eh", "he", "hdsa", "wer", "eds", 0));
        guitarras.add(new Guitarra(1, 1, 1, 1, 1, "eh", "he", "hdsa", "wer", "eds", 0));
        guitarras.add(new Guitarra(1, 1, 1, 1, 1, "eh", "he", "hdsa", "wer", "eds", 0));
        guitarras.add(new Guitarra(1, 1, 1, 1, 1, "eh", "he", "hdsa", "wer", "eds", 0));
        guitarras.add(new Guitarra(1, 1, 1, 1, 1, "eh", "he", "hdsa", "wer", "eds", 0));

        guitarras.add(guitarra);

    }

    public ArrayList<Guitarra> getGuitarras() {

        return new ArrayList<>(guitarras);
    }


}
