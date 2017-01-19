package central;

import  io.motown.ocpp.v15.soap.centralsystem.schema.StartTransactionResponse;


import java.util.Date;
import java.util.Locale;
import java.sql.*;
import java.text.NumberFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import io.motown.ocpp.v15.soap.centralsystem.schema.StopTransactionResponse;
import io.motown.ocpp.v15.soap.centralsystem.schema.AuthorizationStatus;
import io.motown.ocpp.v15.soap.centralsystem.schema.AuthorizeResponse;
import io.motown.ocpp.v15.soap.centralsystem.schema.BootNotificationResponse;
import io.motown.ocpp.v15.soap.centralsystem.schema.HeartbeatResponse;
import io.motown.ocpp.v15.soap.centralsystem.schema.IdTagInfo;
import io.motown.ocpp.v15.soap.centralsystem.schema.RegistrationStatus;

public class CentralSystem {
	
	static private Connection connection;
	//classe per la connessione del server al database
    static class database {
    	static private Connection connection;
    	
    	//Autenticazione e conessione a MySql
        public static void setConnection() {
            try {
                Class.forName("com.mysql.jdbc.Driver");
                connection = DriverManager.getConnection("jdbc:mysql://192.168.0.100:3306/emotionV0.4", "root", "root");
                connection.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE, ResultSet.CONCUR_UPDATABLE);
                //System.out.println("Connessione al database avvenuta con successo!");
            } catch (Exception ex) {
                //System.err.println(ex.getMessage());
            }
        }
        
     // chiusura della connessione
        public static void closeConnection() {
            try {
            	connection.close();
            } catch (Exception ex) {
                ex.printStackTrace();
            }
        }

        // restituisce la connessione
        public static Connection getConnection() {
            return connection;
        }
    	
    }
    
    public static int Realtime(double importo,double kwtot,int transactionId,double kwins) throws Exception{
    	SimpleDateFormat sdf = new SimpleDateFormat("yyyy-M-dd hh:mm:ss");
		String data = "2006-07-09 00:00:00";
		Date dat = sdf.parse(data);
		Timestamp time = new Timestamp(dat.getTime());
		database.setConnection();
		Connection connessione = database.getConnection();
		try{
			String sql = "UPDATE History_Charge SET dataStop = '"+time+"' , importoTot="+importo+" , kwTot = "+kwtot+" , kwInst ="+kwins+" WHERE idHistory="+transactionId+"";
			Statement stu = connessione.createStatement();
			stu.executeUpdate(sql);
			stu.close();
		}catch(Exception e){
			
		}
    	return 1;
    }
    
    private static double round(double value, int places) {
        if (places < 0) throw new IllegalArgumentException();

        long factor = (long) Math.pow(10, places);
        value = value * factor;
        long tmp = Math.round(value);
        return (double) tmp / factor;
    }
    
    
    public String [] StopTransactionConf(long datastop,int meterStop,int transactionId,double importo,double kwtot,String code){
    	double temp = round(importo, 2);
    	double val=0.0;
    	String [] res = new String [6];
    	Timestamp tim = new Timestamp(datastop);
		database.setConnection();
		Connection connessione = database.getConnection();
		String sql = "UPDATE History_Charge SET dataStop = '"+tim+"' , importoTot="+temp+" , kwTot = "+kwtot+" , kwInst = 0 WHERE idHistory="+transactionId+"";
		String sqlreadVal= "SELECT valore FROM Coupon WHERE codice="+code+"";
		String sqlCarica= "UPDATE Presa SET stato = 'Fine Ricarica' WHERE Presa.idPresa = "+meterStop+"";
    	try{
    		Statement stu = connessione.createStatement();
			stu.executeUpdate(sql);
			stu.close();
			Statement readval= connessione.createStatement();
			ResultSet rs =readval.executeQuery(sqlreadVal);
			while(rs.next()){
				val = rs.getDouble("valore");
			}
			readval.close();
			temp = val - temp;
			temp = round(temp, 2);
			String sqlVal= "UPDATE Coupon SET valore="+temp+" WHERE codice="+code+"";
			Statement sta = connessione.createStatement();
			sta.executeUpdate(sqlVal);
			sta.close();
			Statement car = connessione.createStatement();
			car.executeUpdate(sqlCarica);
			car.close();
    	}catch(SQLException e){
    		
    	}
    	res[0]= ""+tim;
    	res[1]= ""+meterStop;
    	res[2]=""+transactionId;
    	res[3]=""+temp;
    	res[4]=""+kwtot;
    	res[5]=""+code;
    	return res;
    }
    
	private void popola_history(Timestamp datStart,Timestamp datStop,Connection connessione, int fkUser, String fkTower,int presa) {
		/*String sql = "INSERT INTO History_Charge (dataStart,dataStop,importoTot,kwTot,fkUser,fkTower,fkPresa) "
				+ "VALUES ('"+datStart+"', '"+datStop+"', "+importoTot+", "+kwTot+", "+fkUser+", "+fkTower+", 1)";*/
		String sql = "INSERT INTO History_Charge (dataStart,dataStop,importoTot,kwTot,fkUser,fkTower,fkPresa,kwInst) "
				+ "VALUES ('"+datStart+"', '"+datStop+"', "+0.0+", "+0.0+", "+fkUser+", "+fkTower+", "+presa+",0)";
		try{
			Statement stmt = connessione.createStatement();
			stmt.executeUpdate(sql);
			stmt.close();
			
		}catch(SQLException e){
			e.getMessage();
		}
	}
    
    public double [] StartTransactionConf(int presa, int meterStart,String idTower,String codeCoupon) throws Exception {
    	double [] ris=new double[4];
    	boolean find=false;
    	StartTransactionResponse conf = new StartTransactionResponse();
    	try{
    		database.setConnection();
            Connection connessione = database.getConnection();
            //aggiorna_timestamp(idTower,connessione);
            //aggiorna timestamp
			//verifica valore coupon
			String sql = "SELECT User_Coupon.fkCoupon, Coupon.codice, Coupon.valore, User.idUser, "
					+ "User.eurKw FROM User JOIN(Coupon JOIN User_Coupon ON "
					+ "Coupon.idCoupon=User_Coupon.fkCoupon) "
					+ "ON User.idUser = User_Coupon.fkUser WHERE User.ruolo = 'gestore'";
			String sqlCarica= "UPDATE Presa SET stato = 'In carica' WHERE Presa.idPresa = "+presa+"";
			
			Statement st = connessione.createStatement();
			ResultSet rs =st.executeQuery(sql);
			while(rs.next()){
				if(rs.getString("codice").equals(codeCoupon)){
					String sqlUser = "SELECT idUser From User Join User_Coupon On User.idUser = User_Coupon.fkUser Where ruolo ='user' "
							+ "AND fkCoupon="+rs.getInt("fkCoupon");
					Statement stut = connessione.createStatement();
					ResultSet ut =stut.executeQuery(sqlUser);
					int prov=0;
					while(ut.next()){
						prov=ut.getInt("idUser");
					}
					ris[0] = 1;
					ris[1] = rs.getDouble("valore");
					ris[2] = rs.getDouble("eurKw");
					find =true;
					
					// popola history
					Date dataStart = new Date();
					long start = 1000 * (dataStart.getTime() / 1000);
					Timestamp datastart = new Timestamp(start);
					popola_history(datastart, datastart, connessione, prov, idTower, presa);
					ut.close();
					String sql_id = "SELECT idHistory FROM History_Charge WHERE dataStart = '" + datastart + "'";
					Statement stmt_id = connessione.createStatement();
					ResultSet rs1 = stmt_id.executeQuery(sql_id);
					while (rs1.next()) {
						conf.setTransactionId(rs1.getInt("idHistory"));
					}
					stmt_id.close();
					rs1.close();

					ris[3] = conf.getTransactionId();

				}
			}
			Statement car = connessione.createStatement();
			car.executeUpdate(sqlCarica);
			car.close();
			st.close();
			rs.close();
			connessione.close();
    	}catch(SQLException e ){
    		e.printStackTrace();
    	}
    	if(find=false){
    		ris[0]=0;
    	}
    	return ris;
		
	}
	
	public String AuthorizeConf(String req, String idtower){
   	 	boolean find=false;
    	AuthorizeResponse ogg = new AuthorizeResponse();
    	Date datJ = new Date();
		Timestamp datSQL = new Timestamp(datJ.getTime());
		IdTagInfo tag = new IdTagInfo();
		try{
    		database.setConnection();
            Connection connessione = database.getConnection();
            String sql = "SELECT Coupon.codice, Coupon.scadenza, Coupon.valore,"
            		+ "User.idUser, User.eurKw FROM User JOIN(Coupon JOIN User_Coupon ON Coupon.idCoupon=User_Coupon.fkCoupon) "
            		+ "ON User.idUser = User_Coupon.fkUser WHERE User.ruolo='gestore'";
            
            Statement st = connessione.createStatement();
			ResultSet rs =st.executeQuery(sql);
			while(rs.next()){
				if(rs.getString("codice").equals(req)){
					find =true;
					if(rs.getDate("scadenza").after(datSQL)){
						tag.setStatus(AuthorizationStatus.ACCEPTED);
						if(rs.getDouble("valore") < rs.getDouble("eurKw")){
							tag.setStatus(AuthorizationStatus.EXPIRED);
						}
						aggiorna_timestamp(idtower,connessione);
						ogg.setIdTagInfo(tag);
						break;
					}else{
						AuthorizationStatus stat = null;
						tag.setStatus(stat.BLOCKED);
						ogg.setIdTagInfo(tag);
						// scadenza non valida
					}
				}
			}
			if(find ==false){
				AuthorizationStatus stat = null;
				tag.setStatus(stat.INVALID);
				ogg.setIdTagInfo(tag);
				// non trovato codice
			}
			st.close();
			rs.close();
			connessione.close();
    	}catch(SQLException e){
    		e.printStackTrace();
    	}
    	return ogg.getIdTagInfo().getStatus().toString();
    }
	
	public boolean aggiornaStatConf(int idpresa){
		database.setConnection();
        Connection connessione = database.getConnection();
		
		String sql_stato = "UPDATE Presa SET stato = 'In attesa' WHERE Presa.idPresa = " + idpresa + "";
		Statement car;
		try {
			car = connessione.createStatement();
			car.executeUpdate(sql_stato);
			car.close();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
			
		
		return true;
	}

	public boolean HeartBeatConf(int live, String rec){
		if(live==666){
			HeartbeatResponse heart = new HeartbeatResponse();
			try{
				database.setConnection();
	            Connection connessione = database.getConnection();
				String sql = "SELECT * FROM Tower WHERE idTower="+rec;
				Statement st = connessione.createStatement();
				ResultSet rs =st.executeQuery(sql);
				while(rs.next()){
					if(rs.getString("idTower").equals(rec)){
						aggiorna_timestamp(rec,connessione);
					}
				}
				st.close();
				rs.close();
				connessione.close();
			}catch(SQLException e){
				e.printStackTrace();
				return false;
			}
			return true;
		}else {
			return false;
		}
	}
	
	
	
	
	@SuppressWarnings("finally")
	private Timestamp aggiorna_timestamp(String rec,Connection connessione) {
		Date datJ = new Date();
		Timestamp datSQL = new Timestamp(datJ.getTime());
		String sql = "UPDATE Tower SET timestamp = '"+datSQL+"' WHERE idTower = "+rec;
		try{
			Statement stu = connessione.createStatement();
			stu.executeUpdate(sql);
			stu.close();
		}catch(SQLException e){
			e.getMessage();
		}finally{
			return datSQL;
		}
	}
	
	
	
	public String [] BootNotificationConf(String []rec){
		BootNotificationResponse conf = new BootNotificationResponse();;
		String [] risposta = new String[3];
		boolean ok=false;

		try{
    		database.setConnection();
            Connection connessione = database.getConnection();
            String sql = "SELECT * FROM Tower WHERE idTower="+rec[2];
            Statement st = connessione.createStatement();
            ResultSet rs =st.executeQuery(sql);
            //cerca l'idtorretta nel database
            while(rs.next()) {
            	if(rs.getString("idTower").equals(rec[2])){
            		//status pacchetto accettato
            		conf.setStatus(RegistrationStatus.ACCEPTED);
            		//aggiorna il timestamp del server nel DB e setta il current time alla stessa ora del server
            		conf.setCurrentTime(aggiorna_timestamp(rec[2],connessione));
        			conf.setHeartbeatInterval(120000);
        			ok=true;
            	}
            }
            if(ok==false) {
            	//se non viene trovata mette lo status a rejected ma cmq restituisce l'ora corrente
            	conf.setStatus(RegistrationStatus.REJECTED);
            	conf.setCurrentTime(aggiorna_timestamp(rec[2],connessione));
    			conf.setHeartbeatInterval(0);
    			
            }
            
            risposta[0] = conf.getStatus().toString();
            risposta[1] = conf.getCurrentTime().toString();
            risposta[2] = ""+conf.getHeartbeatInterval();
            //chiudo connessione db
            database.closeConnection();
            return risposta;
		}catch(SQLException ex){
			conf.setStatus(RegistrationStatus.REJECTED);
			risposta[0] = conf.getStatus().toString();
            //database.closeConnection();
			return risposta;
		}
			
	}
	/*public String[] diobestia(String [] porcamadonna){
	String [] dio = new String [2];
	dio[0] = "PORCO DIO";
	for(int i=0; i<100000; i++){}
	dio[1] = porcamadonna[1];
	return dio;
}*/
	

}
