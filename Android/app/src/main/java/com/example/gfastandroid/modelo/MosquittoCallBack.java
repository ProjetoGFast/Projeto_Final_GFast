package com.example.gfastandroid.modelo;

import android.content.Context;

import org.eclipse.paho.client.mqttv3.IMqttDeliveryToken;
import org.eclipse.paho.client.mqttv3.MqttCallback;
import org.eclipse.paho.client.mqttv3.MqttMessage;
import org.json.JSONObject;

public class MosquittoCallBack implements MqttCallback {
    private Context context;

    public MosquittoCallBack(Context context) {
        this.context = context;
    }


    @Override
    public void connectionLost(Throwable cause) {
        System.out.println("Perda de ligação ao mosquitto");
    }

    @Override
    public void messageArrived(String topic, MqttMessage message) throws Exception {
        JSONObject jsonObject = new JSONObject(message.toString());
        String preco_json = jsonObject.getString("preco");
        float preco = Float.parseFloat(preco_json);
        Guitarra guitarra = new Guitarra(jsonObject.getInt("id"), jsonObject.getString("subcategoria"), jsonObject.getString("marca"), jsonObject.getInt("iva"), preco, jsonObject.getString("nome"), jsonObject.getString("idreferencia"), jsonObject.getString("descricao"), jsonObject.getString("fotopath"), jsonObject.getString("qrcodepath"), jsonObject.getInt("inativo"));
        SingletonGestorGfast.getInstance(context).gfastBDHelper.adicionarGuitarraBD(guitarra);
        SingletonGestorGfast.getInstance(context).guitarrasListener.onRefreshGuitarras();

    }

    @Override
    public void deliveryComplete(IMqttDeliveryToken token) {

    }
}
