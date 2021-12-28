package com.example.gfastandroid.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
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
            view = inflater.inflate(R.layout.item_lista_guitarras, null);
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
        private ImageView imgGuitarra;

        public ViewHolderLista(View view){
            tvModelo = view.findViewById(R.id.tvModelo);
            tvMarca = view.findViewById(R.id.tvMarca);
            tvPreco = view.findViewById(R.id.tvPreco);

            imgGuitarra = view.findViewById(R.id.imgGuitarra);
        }

        public void update(Guitarra guitarra){
            tvModelo.setText(guitarra.getGui_nome());
            tvMarca.setText(guitarra.getGui_idmarca());
             tvPreco.setText(""+guitarra.getGui_preco());
            Glide.with(context)
                    .load(context.getString(R.string.iplocal) + guitarra.getGui_fotopath())
                    .placeholder(R.drawable.logo_gfast)
                    .diskCacheStrategy(DiskCacheStrategy.ALL)
                    .into(imgGuitarra);

        }
    }
}
