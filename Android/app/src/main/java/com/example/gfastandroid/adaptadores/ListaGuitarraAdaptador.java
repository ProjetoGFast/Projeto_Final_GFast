package com.example.gfastandroid.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;

import com.example.gfastandroid.R;
import com.example.gfastandroid.modelo.Guitarra;

import java.util.ArrayList;

public class ListaGuitarraAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Guitarra> guitarras;

    public ListaGuitarraAdaptador(Context context, ArrayList<Guitarra> guitarras) {
        this.context = context;
        this.guitarras = guitarras;
    }

    @Override
    public int getCount() {
        return guitarras.size();
    }

    @Override
    public Object getItem(int i) {
        return guitarras.get(i);
    }

    @Override
    public long getItemId(int i) {
        return guitarras.get(i).getGui_id();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {

        if (inflater == null) {
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        if (view == null) {
            view = inflater.inflate(R.layout.activity_detalhes_guitarras, null);
        }


        ViewHolderLista viewHolderLista = (ViewHolderLista) view.getTag();
        if (viewHolderLista == null) {
            viewHolderLista = new ViewHolderLista(view);
            view.setTag(viewHolderLista);
        }
        viewHolderLista.update(guitarras.get(i));

        return view;
    }

    private class ViewHolderLista{
        private TextView tvModelo,tvMarca, tvPreco, foto;
        private ImageView imgCapa;

        public ViewHolderLista(View view){
            tvModelo = view.findViewById(R.id.tvModelo);
            tvMarca = view.findViewById(R.id.tvMarca);
            tvPreco = view.findViewById(R.id.tvPreco);

           // foto = view.findViewById(R.id.imageView);
        }

        public void update(Guitarra guitarra){
            tvModelo.setText(guitarra.getGui_nome());
            tvMarca.setText(""+guitarra.getGui_idmarca());
             tvPreco.setText(""+guitarra.getGui_preco());
          //  imgCapa.setImageResource(guitarra.getCapa());
        }
    }
}