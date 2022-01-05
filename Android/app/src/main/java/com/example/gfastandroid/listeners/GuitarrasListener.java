package com.example.gfastandroid.listeners;

import com.example.gfastandroid.modelo.Guitarra;

import java.util.ArrayList;

public interface GuitarrasListener {

    void onRefreshGuitarras();

    void onRefreshListaGuitarras(ArrayList<Guitarra> guitarras);
}
