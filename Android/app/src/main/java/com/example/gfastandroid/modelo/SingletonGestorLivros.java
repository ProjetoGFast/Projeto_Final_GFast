package com.example.gfastandroid.modelo;

import com.example.gfastandroid.R;

import java.util.ArrayList;

public class SingletonGestorLivros {

    private ArrayList<Livro> livros;
    private static SingletonGestorLivros instance = null;

    public static synchronized SingletonGestorLivros getInstance(){

        if (instance == null){
            instance = new SingletonGestorLivros();
        }
        return instance;

    }

    public SingletonGestorLivros() {
        gerarDadosDinamicos();
    }

    private void gerarDadosDinamicos(){
        livros = new ArrayList<>();

        Livro livro = new Livro(1, 2021, R.drawable.programarandroid2, "Aula de AMSI", "Nº5", "AMSI-Team");
        livros.add(livro);
    }
    public ArrayList<Livro> getLivros(){
        return new ArrayList<>(livros);
    }
}
