# Statistica

## Definizioni

Popolazione: insieme di tutti gli elementi oggetto di studio (N)

Unità Statistica: Ogni elemento della popolazione. Entità su cui vengono misurate una o più variabili

Variabile (carattere): Una caratterista dell' unità statistica.

## Tipi di Variabili

-   Quantitativa: discreta o indiscreta
-   Qualitativa: tipo Nubile, celibe (ordinale o sconnessa) -> es. da Analfabeta a Laureato ma non si può ordinare per stato sociale

|  Var Qualitative   |       Var Quantitative       |            |                       |
| :----------------: | :--------------------------: | ---------- | --------------------- |
| Sconnesse nominali | rettilinee ordinali >< == != | discrete   | continue (operazioni) |
|      == o !=       |           >< == !=           | operazioni |

## Matrice dei Dati

Unità statistiche sulle y
Variabili di interesse sulle x

### 1° Sintesi (Tabella di Frequenza)

Figli di ogni famiglia (20)

| xi  | ni  |  fi  | Ni  |  Fi  |
| :-: | :-: | :--: | :-: | :--: |
|  0  |  5  | 0.25 |  5  | 0.25 |
|  1  |  5  | 0.25 | 10  | 0.50 |
|  2  |  3  | 0.15 | 13  | 0.65 |
|  3  |  3  | 0.15 | 16  | 0.80 |
|  4  |  4  | 0.20 | 20  |  1   |
|     | 20  |  1   |

xi -> Numero figli

yi -> Quante famiglie

fi -> frequenze relative

Ni-> Frequenza assoluta cumulata

Scomodo per le variabile quantitative continue

Frequenze assolute cumulate -> Ni: numero di unità statistiche che presentano una modalità minore o uguale a x

$$ N_1 = n_1 $$
$$ N_k = N $$

$$
N_i = N_{i-1} + n_i
$$

Frequenze Relative Cumulate

Fi -> somma delle frequenze relative delle entità che presentano una modalità minore o uguale a x

$$
F_i = \frac{N_i}{N}
$$

### 2° Sintesi (Metodo Grafico)

FARE TABELLA
Qual. Nominali: Torta
Qual. Ordinali: A barre
quantitativa discreta: Ad aste
quant. continua: istogramma

sulla x ci sono il numero dei figli e sulle y le freq relative o il numero di famiglie

### 3° Sintesi (Indici Sintetici)

Indici di posizione: indicatori che in un unico valore riassumono l'intera distribuzione dei dati. Danno un'idea dell'ordine di grandezza del fenomeno studiato

-   Media
-   Moda (Su tutti i tipi di variabili)
-   Mediana

#### Media

Con i dati Grezzi

$$
X = \frac{x_1 + x_2 + \cdots + x_n}{N}
$$

Con le frequenze assolute

$$
X = \frac{n_1 * x_1 + n_2 * x_2 + \cdots + n_n * x_n}{N}
$$

Anche con le frequenze relative

non va bene se ci sono outliers -> Valori che influenzano la media

L' unità di misura della media è la stessa del fenomeno

#### La moda

Modalità con frequenza (relativa o assoluta) più alta

é la più semplice da determinare e può essere utilizzata per tutti i tipi di dati

utile quando la classe modale si distingue di molto dalle altre

## Quantili e Quartili

$$
0 < p < 1
$$

$$
X_p
$$

Ordinare i dati grezzi
1 2 4 4 4 5 6

il quattro in mezzo (X4) divide la popolazione in 2 (Mediana)

p = 0.5

primo quartile
Lascia a sinistra il 25% e a destra il 75%

$$
p =\frac{1}{4}
$$

Secondo quartile -> Mediana

Terzo quartile
Lascia a sinistra il 75% e a destra il 25%

$$
p =\frac{3}{4}
$$

Calcolo dei quantili

Np è intero

$$
X_p = \frac{X_{N_p} + X_{N_{p + 1}}}{2}
$$

X_8 = la x in posizione 8

1 2 3 4 5 6 7 8
Mediana = 4.5

p = 0.5

N = 14

N \* p = 7

Mediana = media tra pos 7 e 8
