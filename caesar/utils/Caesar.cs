using System;

namespace Utils
{
  public class Caesar
  {
    public string Alphabet { get; set; }
    public int Shift { get; set; }

    public string Decipher(string input)
    {
      string output = "";
      string alphabet = Alphabet.ToLower();

      foreach (var oldChr in input.ToCharArray())
      {
	var oldIdx = alphabet.IndexOf(Char.ToLower(oldChr));
	var newIdx = (alphabet.Length + oldIdx - Shift) % alphabet.Length;
        var newChr = (oldIdx == -1) ? oldChr : Alphabet[newIdx];

        // Restore original case
        if (Char.IsUpper(oldChr))
          newChr = Char.ToUpper(newChr);

        output += newChr;
      }

      return output;
    }
  }
}
