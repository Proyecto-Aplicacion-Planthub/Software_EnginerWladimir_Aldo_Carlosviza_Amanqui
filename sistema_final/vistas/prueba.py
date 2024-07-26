import sys
import json
import numpy as np
import joblib
import matplotlib.pyplot as plt
import seaborn as sns
import pandas as pd

# Datos hipotéticos para la matriz de correlación
data = {
    "REF": [1, 2, 3, 4, 5],
    "Review Date": [2012, 2013, 2014, 2015, 2016],
    "Cocoa Percent": [70, 72, 74, 76, 78],
    "Rating": [3, 4, 3.5, 4.5, 5]
}

df = pd.DataFrame(data)
corr = df.corr()

plt.figure(figsize=(10, 5))
sns.heatmap(corr, annot=True, cmap='viridis')
plt.title('Matriz de Correlación')

# Guarda la gráfica como imagen
plt.savefig('C:/xampp/htdocs/sistemaventakk/vistas/static/correlation_matrix.png')
plt.close()

try:
    # Leer los parámetros de entrada
    if len(sys.argv) > 1:
        input_params = json.loads(sys.argv[1])

        # Convertir los parámetros de entrada a un formato adecuado para el modelo
        input_data = np.array([input_params])

        # Cargar el modelo entrenado
        model = joblib.load('C:/xampp/htdocs/sistemaventakk/vistas/xgboost_model.pkl')
         # Realizar la predicción
        prediction = model.predict(input_data)
        # Imprimir la predicción en formato JSON
        output = json.dumps({'prediction': prediction.tolist()})
        print(output)
    else:
        print(json.dumps({'error': "No se recibieron parámetros de entrada"}))
except Exception as e:
    print(json.dumps({'error': str(e)}))




