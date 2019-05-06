import java.net.*;
import java.io.*;
import java.util.*;
import javax.json.*;
import javax.json.stream.*;
import javax.json.stream.JsonParser.*;

public class JSONExample{
   public static void main(String[] args){
      try{
         URL url = new URL("http://www.ist.rit.edu/~bdf/454/nationalParks?type=json");
         InputStream is = url.openStream();
         JsonReader rdr = Json.createReader(is);
         // you can also do with strings
         // JsonReader rdr = Json.createReader(new StringReader("yourjsonstring"));
         JsonObject obj = rdr.readObject();
         JsonArray results = obj.getJsonArray("parks");
         for(JsonObject result : results.getValuesAs(JsonObject.class)){
            System.out.print(result.getString("parkName"));
            System.out.print(": ");
            System.out.println(result.getString("parkLocation", ""));
            System.out.println("--------------");
         }
         
         is = url.openStream();
         JsonParser parser = Json.createParser(is);
         while(parser.hasNext()){
            Event e = parser.next();
            if(e == Event.KEY_NAME){
               switch(parser.getString()){
                  case "parkName":
                     parser.next();
                     System.out.print(parser.getString());
                     System.out.print(": ");
                     break;
                  case "parkLocation":
                     parser.next();
                     System.out.println(parser.getString());
                     System.out.println("*************");
                     break;
               }
            }
         }
         
         StringWriter swriter = new StringWriter();
         try(JsonGenerator gen = Json.createGenerator(swriter)){
            gen.writeStartObject();
            gen.writeStartArray("parks");
            for(int i = 0; i < 4; i++){
               gen.writeStartObject().write("parkName", "Park " + (i + 1))
                                     .write("parkLocation", "Location " + (i + 1))
                                     .writeEnd();
            }
            gen.writeEnd(); // array
            gen.writeEnd(); // object
         } 
         System.out.println(swriter.toString());
      }
      catch(Exception e){
         System.out.println(e.getMessage());
      }
   }
}