# Marks

---

- [O que são marks](#marks)

<a name="marks"></a>
## O que são marks    

Para garantir a melhor performance e custos possíveis para hospedagem de servidores de jogos, possuímos diversos servidores dedicados com configurações de hardware diferentes. Cada instância criada em nossos sistema, possui uma cota máxima específica de recursos que é liberada para uso. Para memória RAM, armazenamento em HDD/SSD, essa tarefa é trivial, uma vez que são recursos que não alteram de uma máquina para a outra de forma significativa.

Para limitação de uso de CPU, **pelo fato de variarem em performance significativamente (diferenças em clock, diferenças na arquitetura, cache, etc), utilizamos a unidade `marks` que é calculada com base na performance do processador em si** e são comparáveis entre processadores diferentes.

> {primary} Utilizamos a CPUBenchmark e outros benchmarks para comparar e normalizar os scores das CPUs


Uma instância com cota de CPU de 1500 `marks`, alocada em um servidor dedicado com um processador avaliado em 3000 `marks`, terá uma cota de uso de no máximo 50% de um núcleo do processador.

Semelhantemente, uma instância com cota de 6000 `marks`, no mesmo servidor dedicado, poderá usar até 2 núcleos no máximo.

