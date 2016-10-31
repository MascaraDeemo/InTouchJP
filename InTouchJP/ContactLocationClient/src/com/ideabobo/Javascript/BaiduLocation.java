package com.ideabobo.Javascript;


import org.apache.cordova.CordovaActivity;
import org.json.JSONException;
import org.json.JSONObject;

import com.baidu.location.BDLocation;
import com.baidu.location.BDLocationListener;
import com.baidu.location.LocationClient;
import com.baidu.location.LocationClientOption;
import com.baidu.location.LocationClientOption.LocationMode;

import android.content.Context;
import android.util.Log;
import android.webkit.WebView;
import android.widget.Toast;

public class BaiduLocation {
	public Context ctx= null;
	public JSONObject json = new JSONObject();
	public  LocationClient mLocationClient = null;
	public BDLocationListener myListener = new MyLocationListener();
    private CordovaActivity mGap;
    public static boolean flag = false;
	public BaiduLocation(CordovaActivity mGap){
		this.mGap = mGap;
		ctx = mGap.getApplicationContext();
		mLocationClient = new LocationClient(ctx);
		mLocationClient.registerLocationListener(myListener);
		LocationClientOption option = new LocationClientOption();
		option.setLocationMode(LocationMode.Hight_Accuracy);
		option.setCoorType("bd09ll");
		option.setScanSpan(300000);
		option.setIsNeedAddress(true);
		option.setNeedDeviceDirect(true);
		mLocationClient.setLocOption(option);
		mLocationClient.start();
		
	}
	
	public String getLocation() {
		//Toast.makeText(ctx, "location", Toast.LENGTH_LONG).show();
		flag = true;
		if (mLocationClient != null && mLocationClient.isStarted()) {
			mLocationClient.requestLocation();
		} else {
			Log.d("LocSDK3", "locClient is null or not started");
		}
		return "phonegap";
	}
	
	public class MyLocationListener implements BDLocationListener {
		@Override
		public void onReceiveLocation(BDLocation location) {
			if (location == null)
				return;
			try {
				json.put("time", location.getTime());
				json.put("code", location.getLocType());
				json.put("latitude", location.getLatitude());
				json.put("longitude", location.getLongitude());

				if (location.getLocType() == BDLocation.TypeGpsLocation) {
					json.put("speed", location.getSpeed());
					json.put("satellite", location.getSatelliteNumber());
				} else if (location.getLocType() == BDLocation.TypeNetWorkLocation) {
					json.put("addr", location.getAddrStr());
				}
				//if(flag){
					mGap.sendJavascript("getPositionByBaidu('"+json.toString()+"')");
				//}
				
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			 

			//Toast.makeText(ctx, json.toString()+"flag:"+flag, Toast.LENGTH_LONG).show();
		}

	}
	
	
}
